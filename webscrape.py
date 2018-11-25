from urllib.request import urlopen as uReq
from bs4 import BeautifulSoup as soup
import mysql.connector

#global variable to keep track of max event id
event_id_counter = 1

def main():

    mydb = mysql.connector.connect(host='127.0.0.1', user='root', password='gosantaclara', database='planner')
    mydb.autocommit = True

    url_queue = ['https://www.eventbrite.com/d/ca--san-jose/events/']
    html_tag_queue = []
    event_info_dict = {}

    populateHtmlTagQueue(html_tag_queue)
    scrapeToTextFile(url_queue, html_tag_queue, event_info_dict,mydb)

    mydb.close()

def populateHtmlTagQueue(html_tag_queue):
    html_tag_queue.append({"class": "eds-media-card-content__content"})
    html_tag_queue.append({"class": "card-text--truncated__three"})
    html_tag_queue.append({"class": "date-thumbnail__month"})
    html_tag_queue.append({"class": "date-thumbnail__day"})
    html_tag_queue.append({"class": "card-text--truncated__one"})
    html_tag_queue.append({"class": "eds-media-card-content__sub-content"})

def scrapeToTextFile(url_queue, html_tag_queue, event_info_dict,database):
 
 for url in url_queue:

    #opens a conenction and grabs the webpage
    uClient = uReq(url)
    page_html = uClient.read()
    uClient.close()

    event_list = []

    page_soup = soup(page_html, "html.parser")

    containers = page_soup.findAll("div", html_tag_queue[0])
    html_tag_queue.pop(0)

    for container in containers:

        name_container = container.findAll("div", html_tag_queue[0])
        if len(name_container) != 0:
            #check for duplicates here to not waste time
            if name_container[0].text not in event_list:
                event_info_dict["event_name"] = name_container[0].text
                event_list.append(event_info_dict["event_name"])
            else:
                #if event has already been parsed from another website, go to next iteration of the loop
                continue

        month_container = container.findAll("p", html_tag_queue[1])
        if len(month_container) != 0:
            event_month = month_container[0].text

        day_container = container.findAll("p", html_tag_queue[2])
        if len(day_container) != 0:
            event_day = day_container[0].text

        event_info_dict["event_date"] = str(event_month + " " + event_day)

        location_conatiner = container.findAll("div", html_tag_queue[3])
        if len(location_conatiner) != 0:
            event_info_dict["event_location"] = location_conatiner[0].text

        time_container = container.findAll("div",html_tag_queue[4])
        if len(time_container) != 0:
            event_time = time_container[0].div.text.split(',')
            if len(event_time) >= 2:
                event_time = event_time[2]
                event_info_dict["event_time"] = event_time[0:8]

        event_info_dict["event_id"] = event_id_counter
        event_id_counter = event_id_counter + 1

        populateEventDb(event_info_dict,database)
        event_info_dict.clear
    html_tag_queue.pop[0:5]


def populateEventDb(event_info_dict,database):
    
    mycursor = database.cursor()
    sqlFormula = "INSERT INTO events (ename,location,eventdate,starttime) VALUES (%s,%s,%s,%s,%s)"
    event_info = (event_info_dict["event_id"],event_info_dict["event_name"],event_info_dict["event_location"],
        event_info_dict["event_date"],event_info_dict["event_time"])

    mycursor.execute(sqlFormula,event_info)

main()
