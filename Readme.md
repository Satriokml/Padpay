# Dokumentasi e-money Kelompok 8

## Padpay
PADPAY adalah sebuah api pembayaran yang dapat digunakan sebagai salah satu cara pembayaran di website maos. Beberapa fitur yang dapat dilakukan adalah register, login, pembayaran, cek saldo, top up, dan transfer antar akun PADPAY.

## Penjelasan Fitur
# Register
Pengguna dapat membuat akun untuk melakukan top-up dan pembayaran. Data yang dibutuhkan adalah username, password, dan nomor telepon.

### Endpoint dan Metode
Pada fitur ini, kami menggunakan endpoint `./api/register.php` dan metodenya adalah **POST**. Cara kerjanya adalah pengguna akan menginput email, username, password, dan nomor telpon dengan metode post **POST**. Kemudian data-data tersebut akan dikirim ke database kami.

### Screenshot
![1](https://raw.githubusercontent.com/Satriokml/images/main/padpay/regis.png)

# Login
Setelah membuat akun, pengguna dapat login ke akun mereka untuk melakukan pembayaran. Cara login adalah pengguna akan meminta token JWT untuk authorisasi, kemudian pengguna akan menggunakan token tersebut untuk menggunakan fitur-fitur yang ada di api PADPAY ini.

### Endpoint dan Metode
Pada fitur ini, kami menggunakan endpoint `./api/login.php` dan metodenya adalah **GET**. Cara kerjanya adalah pengguna akan menginput name dan passwordnya nya pada endpoint `./api/login.php`, kemudian akan dikirimkan token JWT.

### Screenshot
![2](https://raw.githubusercontent.com/Satriokml/images/main/padpay/login.png)

# Cek Saldo
Dengan fitur ini, pengguna dapat melihat sisa saldo yang mereka miliki.

### Endpoint dan Metode
Pada fitur ini, kami menggunakan endpoint `./api/profilefetch.php` dan metodenya adalah **GET**. Cara kerjanya adalah pengguna akan menginput email, password, dan token dengan metode post **GET**. Kemudian data-data dari user tersebut akan tampil.

### Screenshot
![3](https://raw.githubusercontent.com/Satriokml/images/main/padpay/fetch.png)


# TopUp
Dengan fungsi ini, pengguna dapat menambah saldo yang terdapat di e-wallet ini yang kemudian dapat digunakan untuk media pembayaran.

### Endpoint dan Metode
Pada fitur ini, kami menggunakan endpoint `./api/topup.php` dan metodenya adalah **POST**. Cara kerjanya adalah admin akan menginput email, password, token, dan jumlah topup dengan metode **POST**, kemudian saldo akan terupdate di database kami.

### Screenshot
![4](https://raw.githubusercontent.com/Satriokml/images/main/padpay/topup.png)

# Transfer
Dengan fungsi ini, pengguna dapat mengirimkan saldo yang terdapat di e-wallet mereka kepada pengguna lain yang terdaftar di padpay.

### Endpoint dan Metode
Pada fitur ini, kami menggunakan endpoint `./api/transaksi.php` dan metodenya adalah **PUT**. Cara kerjanya adalah admin akan menginput email, password, token, dan jumlah transfer, dan nomor telpon tujuan dengan metode **PUT**, kemudian saldo akan terupdate di database kami.

### Screenshot
![5](https://raw.githubusercontent.com/Satriokml/images/main/padpay/trf.png)

# Histori
Dengan fungsi ini, pengguna dapat melihat histori transaksi / transfer yang pernah user tersebut lakukan.

### Endpoint dan Metode
Pada fitur ini, kami menggunakan endpoint `./api/history.php` dan metodenya adalah **GET**. Cara kerjanya adalah admin akan menginput email, password, dan token dengan metode **GET**, kemudian akan ditampilkan seluruh history transaksi.

### Screenshot
![6](https://raw.githubusercontent.com/Satriokml/images/main/padpay/history.png)
