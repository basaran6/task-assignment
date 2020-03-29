# Task Assignment

# Kurulum
```sh
git clone https://github.com/basaran6/task-assignment.git
composer install
```
.env dosyasından veritabanı ayarı yapılması gerekmektedir. 

# Kullanım

Aşağıdaki komut çalıştırılarak providerlardan yer alan tasklar veritabanına aktarılır.

```sh
bin/console app:get-task-from-providers
```
Eğer sadece taskları atama işlemi yapılmak isteniyorsa --only-assign-tasks parametresi kullanılması gerekmektedir.

```sh
bin/console app:get-task-from-providers --only-assign-tasks
```

Eğer hem task verisi aktarılmak isteniyorsa hem de aktarılan tasklar developerlara atanmak isteniyorsa --get-and-assign-tasks parametresi kullanılması gerekmektedir. 

```sh
bin/console app:get-task-from-providers --get-and-assign-tasks
```

# Ekran Görüntüleri

# Boş Karşılama Ekranı
![first_page](https://user-images.githubusercontent.com/15363846/77855220-af4ad800-71f7-11ea-8e7e-ace950dda288.png)
# Developer Ekleme Sayfası
Sistem ilk açıldığında tanımlı developer bulunmamaktadır. Developer tanımlaması yapılması gerekmektedir.
![developer_ekleme](https://user-images.githubusercontent.com/15363846/77855219-af4ad800-71f7-11ea-9b17-3901a45f13a8.png)
# Developer Listeleme Sayfası
![developer_list](https://user-images.githubusercontent.com/15363846/77855218-aeb24180-71f7-11ea-8a37-5b4b5856faa9.png)
# Developer Detay Sayfası
![developer_detail](https://user-images.githubusercontent.com/15363846/77855217-ae19ab00-71f7-11ea-88bd-7db263460fd5.png)
# Task Listeleme Sayfası
![task_list](https://user-images.githubusercontent.com/15363846/77855216-ad811480-71f7-11ea-98da-c925965e082d.png)
