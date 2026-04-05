# WarehouseEakkarnyangNew - Warehouse Management System
ระบบบริหารจัดการคลังสินค้าและสต็อกสินค้า (เอกการยาง)

## Project Overview
ระบบบริหารจัดการคลังสินค้าที่พัฒนาขึ้นเพื่อเพิ่มประสิทธิภาพในการควบคุมสต็อกสินค้าที่มีความหลากหลายสูง ของศูนย์บริการรถยนต์ โดยเน้นความถูกต้องแม่นยำของข้อมูล การติดตามการเคลื่อนไหวของสินค้า และการเชื่อมโยงข้อมูลระหว่างคลังสินค้าหลักกับสาขาต่างๆ

## Tech Stack
* **Framework:** Laravel 5.7 (PHP)
* **Database:** MySQL (Relational Database Design สำหรับระบบคลังสินค้า)
* **Frontend:** Bootstrap, jQuery
* **Key Features:** * Multi-Warehouse Support (รองรับคลังสินค้าหลายแห่ง)
    * Stock In/Out (ระบบรับเข้า-จ่ายออก)

## Key Functional Modules & Business Logic

* **Centralized Inventory Control:** ระบบจัดการสต็อกรวมที่สามารถตรวจสอบยอดสินค้าคงเหลือแยกตามสาขาและตำแหน่งจัดเก็บ (Location Tracking) ได้ทันที
* **Product Categorization & Specifications:** ระบบจัดการข้อมูลสินค้าที่ละเอียดสูง รองรับ Attribute เฉพาะของยางรถยนต์ (Brand, Model, Size, DOT)
* **Reporting:** ระบบรายงานสรุปสต็อกคงเหลือ

## Technical Achievements
* **Inventory Accuracy Logic:** พัฒนาระบบตัดสต็อกและเพิ่มสต็อกที่แม่นยำ โดยใช้ Database Transactions เพื่อป้องกันความผิดพลาดของจำนวนสินค้าเมื่อมีการใช้งานพร้อมกัน
* **Large Data Handling:** ปรับแต่งการ Query ข้อมูลสินค้าที่มีจำนวนมาก ให้แสดงผลและค้นหาได้อย่างรวดเร็ว
* **Scalable Schema Design:** ออกแบบโครงสร้างฐานข้อมูลให้ยืดหยุ่น รองรับการเพิ่มประเภทสินค้าใหม่ๆ หรือการขยายคลังสินค้าในอนาคต

## Project Preview

<img width="150" height="150" alt="image" src="https://github.com/user-attachments/assets/f2f8c6d9-6128-4e01-937e-e49765017fae" />
<img width="150" height="150" alt="image" src="https://github.com/user-attachments/assets/e2fdd4b5-f15a-4310-9ada-bbb547c37115" />
<img width="150" height="150" alt="image" src="https://github.com/user-attachments/assets/0b66737a-2595-490f-99b6-ebe6f36d1364" />



---
