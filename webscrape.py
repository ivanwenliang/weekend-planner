from urllib.request import urlopen as uReq
from bs4 import BeautifulSoup as soup
def main():

    my_Url = 'https://www.eventbrite.com/d/ca--san-jose/events/'

    scrapeToTextFile(my_Url)


def scrapeToTextFile(my_Url):

    #opens a conenction and grabs the webpage
    uClient = uReq(my_Url)
    page_html = uClient.read()
    uClient.close()

    page_soup = soup(page_html, "html.parser")

    containers = page_soup.findAll("div", {"class": "eds-media-card-content__content"})

    for container in containers:
        name_container = container.findAll("div", {"class": "card-text--truncated__three"})
        event_name = name_container[0].text

        month_container = container.findAll("p", {"class": "date-thumbnail__month"})
        event_month = month_container[0].text

        day_container = container.findAll("p", {"class": "date-thumbnail__day"})
        event_day = day_container[0].text

        location_conatiner = container.findAll("div", {"class": "card-text--truncated__one"})
        event_location = location_conatiner[0].text

        #time_container = container.findAll("div",{"class": "eds-text-bs--fixed eds-text-color--grey-600 eds-1-mar-top-1"})
        #event_time = time_container[0].text.split(',')
        #event_time = event_time[3]
        print(event_location)

main()
