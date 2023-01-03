Do at least ONE of the following tasks: refactor is mandatory. Write tests is optional, will be good bonus to see it. 
Please do not invest more than 2-4 hours on this.
Upload your results to a Github repo, for easier sharing and reviewing.

Thank you and good luck!



Code to refactor
=================
1) app/Http/Controllers/BookingController.php
2) app/Repository/BookingRepository.php

Code to write tests (optional)
=====================
3) App/Helpers/TeHelper.php method willExpireAt
4) App/Repository/UserRepository.php, method createOrUpdate


----------------------------

What I expect in your repo:

X. A readme with:   Your thoughts about the code. What makes it amazing code. Or what makes it ok code. Or what makes it terrible code. How would you have done it. Thoughts on formatting, structure, logic.. The more details that you can provide about the code (what's terrible about it or/and what is good about it) the easier for us to assess your coding style, mentality etc
ANS. My thoughts about the code are ok; the code is cleanly written but lacks a lot of changes; you are using a repository pattern in your code but missing the interface class, which is part of the repository design pattern. Interface classes define all the functions definition which should be implemented in the repository class. Also, the function is missing return types and params type casting, which helps to restrict anonymous data from being sent through the request; like, if the id is an integer, it must accept integer values instead of a string, array, etc. it helps to validate request params type easily. So I have created two interface classes 1 is the base interface class and two is the booking interface class, so I tried to refactor as much as possible, but I will give you an idea of how it should be written and used. Secondly, I can see there is no way to handle any exceptions, which is not a good practice. Every part of the code is written in a positive response, which could be wrong. Anything could happen, like database query error, programmatical error, etc., so I have added try catch in some of the functions so we can handle the exceptions as well. Also, I have added a ResponseApi trait which helps to return responses in a more generalized way. Now its json based; you can change it according to your needs. You can use a trait to define helper functions. I also refactored the sendPushNotificationToSpecificUsers curl and created a helper function that helps us use this function anywhere in the project. The best practice is that third-party service should be generalized and globally accessible so we can use its functions anywhere in the project. Let's write code in such a way that it should not be repetitive, and if its function is required anywhere in the project, it should be easily accessible. So everything should be generalized and clean. 
I have also seen in the code that for role management, we are using static ids to check user roles which is, I think, not a good practice; everything should be dynamic even though laravel also provides an incredible package Spatie for Role Permissions, which is very good for Access Control System and easily implemented. Secondly, I can see in the code for accessing authenticated users data you are using the __authenticatedUser object in the request to access user data. Maybe I could not understand it correctly, but it should be accessible through Auth::user(). 
I have also added DB transactions in the storeJobEmail function. I frequently use it whenever I am storing or updating data which helps me not to save corrupted data in the database. The best part is to roll back the transaction if any error occurs in the code. So I can see that it may not be required in the booking repository. Still, I can feel in most of the functions in which data is stored, we can use laravel jobs (if the data is large) as well to save data in the background, which helps to receive a fast response from the server user doesn't need to wait from the API and also keep us from server timeout. So that's it from my side. I tried as much as possible to refactor the code. I hope you will like my coding capabilities and coding sense.

And 

Y.  Refactor it if you feel it needs refactoring. The more love you put into it. The easier for us to asses your thoughts, code principles etc


IMPORTANT: Make two commits. First commit with original code. Second with your refactor so we can easily trace changes. 


NB: you do not need to set up the code on local and make the web app run. It will not run as its not a complete web app. This is purely to assess you thoughts about code, formatting, logic etc


===== So expected output is a GitHub link with either =====

1. Readme described above (point X above) + refactored code 
OR
2. Readme described above (point X above) + refactored core + a unit test of the code that we have sent

Thank you!


