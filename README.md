Make sure you dont forget to change the QUEUE_CONNECTION in the env.

I didnt seed a lot of users since I don't think it would really be
 any difference this there would be no way to really check
 if the emails got to the receiver. 
 
 I will add myself in there just so its not empty, and real emails
  would be ones that have agrees_to_newsletter as true, so when you add yours (manually)
   make sure you have that checked.
   
Now I'm not sure why you wanted all this to be activated by a console command
so I didnt do it like that, the functionality is activated by addressing an endpoint.
But if it is crusial its not hard to set up, let me know if its necessary.
 
 
 Successful example in local environment with using real smtp provider:
<img src="https://i.imgur.com/Hjs8acl.png"></img>
<img src="https://i.imgur.com/Anu78yZ.png"></img>
