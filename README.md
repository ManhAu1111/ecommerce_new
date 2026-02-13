# 🧸 TOY MARK – SÀN THƯƠNG MẠI ĐIỆN TỬ ĐỒ CHƠI TRẺ EM

TOY MARK là website thương mại điện tử chuyên bán **đồ chơi trẻ em**, được xây dựng bằng Laravel + Vue.js (Inertia.js).  

Điểm nổi bật của hệ thống là:

- 🎯 Hiển thị sản phẩm bằng mô hình 3D
- 📧 Đăng ký tài khoản bằng OTP gửi qua Email
- 🔐 Phân quyền rõ ràng giữa khách hàng và quản lý

---

## 🚀 Công nghệ sử dụng

### Backend
- Laravel
- MySQL
- Authentication
- Mail (SMTP gửi OTP)

### Frontend
- Vue.js
- Inertia.js
- Vite

### Thư viện & CDN
- Swiper JS (Slider)
- Font Awesome (Icon)
- Flaticon (Icon UI)
- @google/model-viewer (Hiển thị mô hình 3D)
- EGJS Flicking (Carousel)

---

## 👥 Phân quyền người dùng

### 1️⃣ Khách hàng
- Đăng ký tài khoản (xác thực OTP qua Email)
- Đăng nhập / Đăng xuất
- Xem danh sách sản phẩm
- Xem chi tiết sản phẩm
- Tương tác với mô hình 3D
- Thêm vào giỏ hàng
- Thanh toán

---

### 2️⃣ Quản lý (Admin)

Tài khoản mặc định:

Email: `admin@toyshop.com`  
Password: `12345678`

Chức năng:

- Quản lý sản phẩm (Thêm / Sửa / Xóa)
- Quản lý đơn hàng
- Quản lý người dùng
- Quản lý nội dung hệ thống

---

## 🌟 Tính năng nổi bật

### 🧩 1. Hiển thị sản phẩm bằng mô hình 3D

Hệ thống tích hợp `model-viewer` để hiển thị mô hình 3D (.glb / .gltf) trực tiếp trên trình duyệt:

- Xoay 360°
- Zoom in / Zoom out
- Tương tác trực tiếp
- Hỗ trợ trên mobile

Giúp tăng trải nghiệm người dùng và trực quan hóa sản phẩm tốt hơn.

---

### 📧 2. Đăng ký bằng OTP Email

Quy trình:

1. Người dùng nhập email khi đăng ký
2. Hệ thống gửi mã OTP qua email
3. Người dùng nhập OTP để xác thực
4. Tài khoản được kích hoạt

Ưu điểm:
- Xác thực email hợp lệ
- Tăng tính bảo mật
- Tránh tài khoản giả

---

### 🛒 3. Chức năng thương mại điện tử

- Trang danh sách sản phẩm
- Trang chi tiết sản phẩm
- Giỏ hàng
- Thanh toán
- Quản lý đơn hàng
- Dashboard quản trị

---

## 📂 Cấu trúc dự án

```text
toy-mark/
│
├── app/
├── database/
├── resources/
│ ├── js/
│ ├── views/
│
├── public/
│ ├── assets/
│
├── routes/
├── storage/
├── vite.config.js
└── README.md
```

---

## ⚙️ Cài đặt và chạy dự án

### 1️⃣ Clone project

```text
git clone <repository-url>
cd toy-mark 
```

### 2️⃣ Cài đặt backend

```text
composer install
cp .env.example .env
php artisan key:generate
```

Cấu hình database trong file `.env`

```text
php artisan migrate
php artisan db:seed
```

### 3️⃣ Cài đặt frontend

```text
npm install
npm run dev
```


### 4️⃣ Chạy server

```text
php artisan serve
```
Truy cập:  http://127.0.0.1:8000


---

## 🎯 Mục tiêu dự án

- Ứng dụng mô hình thương mại điện tử vào thực tế
- Kết hợp Laravel + Vue.js theo mô hình SPA
- Tăng trải nghiệm người dùng với công nghệ 3D
- Xây dựng hệ thống xác thực OTP qua Email

---



