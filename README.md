# miniaspire
###### Setup
Change Database name, user, and password from .env file

Run given command 
```
1. composer update
2. php artisan migrate
3. php artisan serve
```

Done!

## API
#### New USER API
```
HTTP Request: Post
Parameters: email, name, password
url: /user/save
```

#### New Loan API
```
HTTP Request: Post
Parameters: user_id, amount, duration, loan_rate
url: /loan/save
```

#### Repayment API
```
HTTP Request: Post
Parameters: user_id, loan_id, installment, receive_amount
url: /repayment/save
```

Note: If the user has taken loan for 5 months, then the installment will be 1, 2, 3, 4, 5

if 3 months long then  1, 2, 3

```
Sample User registration Request URL: http://127.0.0.1:8000/api/user/save?email=memotiur@gmail.com&name=Motiur Rahaman&password=123456

Sample Loan API URL
http://127.0.0.1:8000/api/loan/save?loan_rate=1.5&user_id=1&amount=10000&duration=3

Sample Repayment API:
http://127.0.0.1:8000/api/repayment/save?receive_amount=3484 &user_id=1&loan_id=1&installment=1

```




