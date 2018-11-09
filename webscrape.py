from urllib.request import urlopen as uReq
from bs4 import BeautifulSoup as soup

def main():

    url_queue = 'https://www.eventbrite.com/d/ca--san-jose/events/'
    html_tag_queue = []
    event_info_dict = {}

    populateHtmlTagQueue(html_tag_queue)
    scrapeToTextFile(url_queue, html_tag_queue, event_info_dict)

def populateHtmlTagQueue(html_tag_queue):
	html_tag_queue.append({"class": "eds-media-card-content__content"})
	html_tag_queue.append({"class": "card-text--truncated__three"})
	html_tag_queue.append({"class": "date-thumbnail__month"})
	html_tag_queue.append({"class": "date-thumbnail__day"})
	html_tag_queue.append({"class": "card-text--truncated__one"})
	html_tag_queue.append({"class": "eds-media-card-content__sub-content"})

def scrapeToTextFile(url_queue, html_tag_queue, event_info_dict):
 
    #opens a conenction and grabs the webpage
    uClient = uReq(url_queue)
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
            event_info_dict["event_month"] = month_container[0].text

        day_container = container.findAll("p", html_tag_queue[2])
        if len(day_container) != 0:
        	event_info_dict["event_day"] = day_container[0].text

        location_conatiner = container.findAll("div", html_tag_queue[3])
        if len(location_conatiner) != 0:
            event_info_dict["event_location"] = location_conatiner[0].text

        time_container = container.findAll("div",html_tag_queue[4])
        if len(time_container) != 0:
            event_time = time_container[0].div.text.split(',')
            event_time = event_time[2]
            event_info_dict["event_time"] = event_time[0:8]
        
        print(event_info_dict["event_name"])
        #populateEventDb(event_info_dict)
        event_info_dict.clear

#def populateEventDb(event_info_dict):
	#TODO: Learn mySQLconnector library

main()
