## 쿠폰 생성

- /        : 로그인 페이지 
- /make    : 쿠폰 생성 페이지
- /list    : 쿠폰 리스트 (?group={그룹명})
- /statics : 쿠폰 사용 현황
- /use     : 쿠폰 사용 페이지

## DB 스키마
- users table
  --
  - id(pk, 회원번호)
  - email(unique, 이메일, 로그인에 사용)
  - name(유저 이름)
  - password(비밀번호)
  
- coupons table
    --
    - id            (pk, 쿠폰 고유번호)
    - coupon_code   (unique, 쿠폰 코드)
    - user_id       (fk->users table, 시용 유저 번호)
    - coupongroup_id(fk->coupongroup table, 쿠폰 그룹 번호)
    - used_at       (쿠폰 사용 시점)
    
- couponsgroup table
    --
    - id (pk, 쿠폰 그룹 고유번호)
    - grp_name(unique, 쿠폰 그룹 이름)
