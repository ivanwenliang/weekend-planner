#BEFORE YOU RUN THIS SCRIPT MAKE SURE YOU HAVE DONE THE FOLLOWING:
#1)Make sure you have python and pip installed
#2)Use pip to install BeautifulSoup(bs4) and the request library
#3)Change your PATH to python, we chanegd it for SQL but you need to change it back to python to use python

from urllib.request import urlopen as uReq
from bs4 import BeautifulSoup as soup
def main():

    my_Url = 'dummyURL'

   #opens a conenction and grabs the webpage
    uClient = uReq(my_Url)
    page_html = uClient.read()
    uClient.close()

    page_soup = soup(page_html, "html.parser")

    containers = page_soup.findAll("div", {"class": "eds-media-card-content__content"})

    for container in containers:
        event_container = container.findAll("div", {"class": "card-text--truncated__three"})
        event_name = event_container[0].text
