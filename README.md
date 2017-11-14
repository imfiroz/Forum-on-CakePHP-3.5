# Forum-on-CakePHP-3.5
Simple Forum created using PHP framework CakePHP 3.5 
This forum was two level moderation one is Admin and Regular user.
1. Using same logged in admin and regular user can access their account
2. Admin can moderate all user database
3. Admin have rights to publish a topics after that it is available for post 
4. All posts controls Admin can do changes 
5. User can create number of topics and can post on any of publish topics

Table Structure:
1. users (id, username, password, full_name, email, phone, role)
2. topics (id, user_id, title, visibility)
3. posts (id, user_id, topic_id, body)

Currently it have default UI of cakephp 3.5 which is using Zurb Foundation
