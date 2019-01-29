# desiformal
ทดสอบพัฒนาด้วยระบบ Laravel จากเดิมที่เป็นแบบ Plain PHP

# ผู้พัฒนา
Mr.Nattaphon Suparsri

# ความสามารถของโปรแกรม
1. สามารถเพิ่ม ลบ แก้ไข Portfolio ของเว็บไซต์ได้
2. สามารถเพิ่ม ลบ คิวการรับงานได้

# ความต้องการของโปรแกรม
1. PHP version 7.1.3 หรือมากกว่า
2. ฐานข้อมูล MySQL
3. Composer

# การติดตั้ง
1. ดาวน์โหลด Project มาแล้ว เปิด Command line เข้าไปโฟล์เดอร์ Project
2. พิมพ์ composer install
3. สร้างฐานข้อมูลชื่อ lv_desiformal
4. เข้าโฟลเดอร์โปรเจค สร้างไฟล์ .env (ก๊อปไฟล์ .env.example) ถ้าใครสร้างไม่ได้ให้สร้างบน Editor, IDE
5. ตั้งค่าฐานข้อมูลในไฟล์ .env ในตัวแปรที่มี คือ DB_ นำหน้า ให้ใส่ DB_DATABASE=lv_desiformal และแก้ไขในส่วน Username และ password
6. พิมพ์ php artisan key:generate
7. พิมพ์ php artisan migrate
8. พิมพ์ php artisan db:seed
9. พิมพ์ php artisan serve
10. เข้าเว็บ http://localhost:8000
11. เข้า AdminCP เพื่อจัดการ http://localhost:8000/admincp
12. Email: admin@desiformal.com , Password: 123456
