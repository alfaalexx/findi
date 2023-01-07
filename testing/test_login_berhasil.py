from selenium import webdriver
from selenium.webdriver.common.by import By
import time

### BERHASIL

for x in range(3):
    print(x)
    options = webdriver.ChromeOptions()
    options.add_experimental_option('excludeSwitches', ['enable-logging'])
    web = webdriver.Chrome(executable_path='C:/chromedriver.exe', options=options)
    web.get('http://localhost/findi/login.php') 
    time.sleep(0.5)

    Nama = "alfaalex1"
    writeNama = web.find_element(By.XPATH, '//*[@id="username"]')
    writeNama.send_keys(Nama)
    time.sleep(0.5)

    Password = "12345"
    writePassword = web.find_element(By.XPATH, '//*[@id="password"]')
    writePassword.send_keys(Password)
    time.sleep(0.5)

    SUBMIT = web.find_element(By.XPATH, '/html/body/div/div[2]/form/button')
    SUBMIT.click()
    time.sleep(0.5)
