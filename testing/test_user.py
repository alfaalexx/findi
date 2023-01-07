from selenium import webdriver
from selenium.webdriver.common.by import By
import time

for x in range(1):
    print(x)
    options = webdriver.ChromeOptions()
    options.add_experimental_option('excludeSwitches', ['enable-logging'])
    web = webdriver.Chrome(executable_path='C:/chromedriver.exe', options=options)
    web.get('http://localhost/findi/index.php') 
    time.sleep(0.5)

    kelas1 = "TRPL 1A PAGI"
    inputKelas1 = web.find_element("xpath",'/html/body/div/div/main/div[2]/div/div[1]/div/div[2]/label/input')
    inputKelas1.send_keys(kelas1)
    time.sleep(1)

    search1 = web.find_element("xpath",'/html/body/div[1]/nav/div/ul/li[3]')
    search1.click()
    time.sleep(1)

    dosen1 = "Alfa Alexandra"
    inputDosen1 = web.find_element("xpath",'/html/body/div[1]/div/main/div[2]/form/center/div/div/input')
    inputDosen1.send_keys(dosen1)
    time.sleep(1)

    search2 = web.find_element("xpath",'/html/body/div[1]/div/main/div[2]/form/center/div/div/button')
    search2.click()
    time.sleep(1)

    search3 = web.find_element("xpath",'/html/body/div[1]/div/main/div[4]/div/div[1]/div/div/div[1]/table/thead/tr/th[2]/a')
    search3.click()
    time.sleep(1)

    search4 = web.find_element("xpath",'/html/body/div/nav/div/ul/li[4]')
    search4.click()
    time.sleep(1)

    search5 = web.find_element("xpath",'/html/body/div/nav/div/ul/li[2]')
    search5.click()
    time.sleep(1)

    kelas2 = "TRPL 2A PAGI"
    inputKelas2 = web.find_element("xpath",'/html/body/div/div/main/div[2]/div/div[1]/div/div[2]/label/input')
    inputKelas2.send_keys(kelas2)
    time.sleep(1)

    
    search1 = web.find_element("xpath",'/html/body/div[1]/nav/div/ul/li[3]')
    search1.click()
    time.sleep(1)

    dosen2 = "Noper Ardi"
    inputDosen2 = web.find_element("xpath",'/html/body/div[1]/div/main/div[2]/form/center/div/div/input')
    inputDosen2.send_keys(dosen2)
    time.sleep(1)

    search2 = web.find_element("xpath",'/html/body/div[1]/div/main/div[2]/form/center/div/div/button')
    search2.click()
    time.sleep(1)

    search3 = web.find_element("xpath",'/html/body/div[1]/div/main/div[4]/div/div[1]/div/div/div[1]/table/thead/tr/th[2]/a')
    search3.click()
    time.sleep(1)
    