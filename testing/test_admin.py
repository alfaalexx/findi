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

    # Login 
    login1 = web.find_element("xpath",'/html/body/div/nav/div/ul/li[1]/div/a')
    login1.click()
    time.sleep(1)
        
    login2 = web.find_element("xpath",'/html/body/div/nav/div/ul/li[1]/div/div/a')
    login2.click()
    time.sleep(1)
        
    username = "alfaalex1"
    inputUserName = web.find_element("xpath",'/html/body/div/div[2]/form/div[1]/div[2]/input')
    inputUserName.send_keys(username)
    time.sleep(1)
        
    password = "12345"
    inputPassword = web.find_element("xpath",'/html/body/div/div[2]/form/div[2]/div[2]/input')
    inputPassword.send_keys(password)
    time.sleep(1)
        
    login3 = web.find_element("xpath",'/html/body/div/div[2]/form/button')
    login3.click()
    time.sleep(2)


    #Tambah Kelas
    manage4 = web.find_element("xpath",'/html/body/div/nav/div/ul/li[4]')
    manage4.click()
    time.sleep(1)

    manage5 = web.find_element("xpath",'/html/body/div/div/main/div[2]/a')
    manage5.click()
    time.sleep(1)

    manage_kelass = "TRPL 2A PAGI"
    inputKelas2 = web.find_element("xpath",'/html/body/div[1]/div/main/div[3]/div/div[1]/div[1]/div/div/div[2]/div[1]/input')
    inputKelas2.send_keys(manage_kelass)
    time.sleep(1)

    manage_prodi = "D4 - Teknologi Rekayasa Perangkat Lunak"
    inputProdi1 = web.find_element("xpath",'/html/body/div[1]/div/main/div[3]/div/div[1]/div[1]/div/div/div[2]/div[2]/input')
    inputProdi1.send_keys(manage_prodi)
    time.sleep(1)

    manage_jurusan = "Teknik Informatika"
    inputJurusan1 = web.find_element("xpath",'/html/body/div[1]/div/main/div[3]/div/div[1]/div[1]/div/div/div[2]/div[3]/input')
    inputJurusan1.send_keys(manage_jurusan)
    time.sleep(1)

    manage6 = web.find_element("xpath",'/html/body/div[1]/div/main/div[3]/div/div[1]/div[1]/div/div/div[2]/div[4]/button[2]')
    manage6.click()
    time.sleep(1)

    manage7 = web.find_element("xpath",'/html/body/div/nav/div/ul/li[4]')
    manage7.click()
    time.sleep(1)

    cari_kelas = "TRPL 2A PAGI"
    inputCariKelas1 = web.find_element("xpath",'/html/body/div/div/main/div[3]/div/div[1]/div[295]/div[2]/label/input')
    inputCariKelas1.send_keys(cari_kelas)
    time.sleep(1)

    

    # Tambah Matkul
    manage = web.find_element("xpath",'/html/body/div/nav/div/ul/li[3]')
    manage.click()
    time.sleep(1)
    
    manage2 = web.find_element("xpath",'/html/body/div/div/main/div[2]/a')
    manage2.click()
    time.sleep(1)

    manage_dosen = "NR"
    inputDosen1 = web.find_element("xpath",'/html/body/div[1]/div/main/div[3]/div/div[1]/div[1]/div/div/div[2]/div[1]/input')
    inputDosen1.send_keys(manage_dosen)
    time.sleep(1)

    manage_kelas = "TRPL 2A PAGI"
    inputKelas1 = web.find_element("xpath",'/html/body/div[1]/div/main/div[3]/div/div[1]/div[1]/div/div/div[2]/div[2]/input')
    inputKelas1.send_keys(manage_kelas)
    time.sleep(1)

    manage_hari = "Senin"
    inputHari1 = web.find_element("xpath",'/html/body/div[1]/div/main/div[3]/div/div[1]/div[1]/div/div/div[2]/div[3]/input')
    inputHari1.send_keys(manage_hari)
    time.sleep(1)

    manage_waktu = "08.40 - 09.30"
    inputWaktu1 = web.find_element("xpath",'/html/body/div[1]/div/main/div[3]/div/div[1]/div[1]/div/div/div[2]/div[4]/input')
    inputWaktu1.send_keys(manage_waktu)
    time.sleep(1)

    manage_matkul = "RPL105-Prak Pemrograman Web"
    inputMatkul1 = web.find_element("xpath",'/html/body/div[1]/div/main/div[3]/div/div[1]/div[1]/div/div/div[2]/div[5]/input')
    inputMatkul1.send_keys(manage_matkul)
    time.sleep(1)

    manage_ruangan = "Online"
    inputRuangan1 = web.find_element("xpath",'/html/body/div[1]/div/main/div[3]/div/div[1]/div[1]/div/div/div[2]/div[6]/input')
    inputRuangan1.send_keys(manage_ruangan)
    time.sleep(1)

    manage3 = web.find_element("xpath",'/html/body/div[1]/div/main/div[3]/div/div[1]/div[1]/div/div/div[2]/div[7]/button[2]')
    manage3.click()
    time.sleep(1)


    # Tambah Dosen
    manage8 = web.find_element("xpath",'/html/body/div/nav/div/ul/li[5]')
    manage8.click()
    time.sleep(1)

    manage9 = web.find_element("xpath",'/html/body/div[1]/div/main/div[3]/a')
    manage9.click()
    time.sleep(1)

    manage_dosen2 = "Alfa Alexandra"
    inputdosen2 = web.find_element("xpath",'/html/body/div[1]/div/main/div[4]/div/div[2]/div/div/div[2]/form/div[1]/input')
    inputdosen2.send_keys(manage_dosen2)
    time.sleep(1)

    manage_nidn = "130604"
    inputNidn = web.find_element("xpath",'/html/body/div[1]/div/main/div[4]/div/div[2]/div/div/div[2]/form/div[2]/input')
    inputNidn.send_keys(manage_nidn)
    time.sleep(1)

    manage_KodeDosen = "AX"
    inputKodeDosen = web.find_element("xpath",'/html/body/div[1]/div/main/div[4]/div/div[2]/div/div/div[2]/form/div[3]/input')
    inputKodeDosen.send_keys(manage_KodeDosen)
    time.sleep(1)

    manage_status = "Dosen"
    inputStatus= web.find_element("xpath",'/html/body/div[1]/div/main/div[4]/div/div[2]/div/div/div[2]/form/div[4]/input')
    inputStatus.send_keys(manage_status)
    time.sleep(1)

    manage_prodi2 = "Rekayasa Keamanan Siber"
    inputProgramStudi2= web.find_element("xpath",'/html/body/div[1]/div/main/div[4]/div/div[2]/div/div/div[2]/form/div[5]/input')
    inputProgramStudi2.send_keys(manage_prodi2)
    time.sleep(1)
    
    manage_pendidikan = "Sarjana Terapan (DIV)"
    inputPendidikan= web.find_element("xpath",'/html/body/div[1]/div/main/div[4]/div/div[2]/div/div/div[2]/form/div[6]/input')
    inputPendidikan.send_keys(manage_pendidikan)
    time.sleep(1)

    manage_email = "alfa@polibatam.ac.id"
    inputEmail= web.find_element("xpath",'/html/body/div[1]/div/main/div[4]/div/div[2]/div/div/div[2]/form/div[7]/input')
    inputEmail.send_keys(manage_email)
    time.sleep(1)

    manage10 = web.find_element("xpath",'/html/body/div[1]/div/main/div[4]/div/div[2]/div/div/div[2]/form/div[9]/button[2]')
    manage10.click()
    time.sleep(1)

    cari_dosen = "Alfa Alexandra"
    inputDosen3= web.find_element("xpath",'/html/body/div[1]/div/main/div[2]/form/center/div/div/input')
    inputDosen3.send_keys(cari_dosen)
    time.sleep(1)

    manage11 = web.find_element("xpath",'/html/body/div[1]/div/main/div[2]/form/center/div/div/button')
    manage11.click()
    time.sleep(1)

    manage12 = web.find_element("xpath",'/html/body/div[1]/div/main/div[4]/div/div[1]/div/div[2]/div[1]/table/thead/tr/th[2]/a')
    manage12.click()
    time.sleep(1)


    # Logout
    logout = web.find_element("xpath",'/html/body/div/nav/div/ul/li[2]')
    logout.click()
    time.sleep(1)

    logout1 = web.find_element("xpath",'/html/body/div/nav/div/ul/li[1]/div/a')
    logout1.click()
    time.sleep(1)
        
    logout2 = web.find_element("xpath",'/html/body/div/nav/div/ul/li[1]/div/div/a')
    logout2.click()
    time.sleep(1)

    logout_3 = web.find_element("xpath",'/html/body/div/div/main/div/div/div/div/div/div[3]/a')
    logout_3.click()
    time.sleep(1)

    

