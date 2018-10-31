# Honor Help (tutors.concordiashanghai.org) The National Honor Society/National Science Honor Society Website

<p>
This is primarily a tutoring and service management system on a website using php, mysql, javascript, html and css. This is my second major website project.
<br>
This system allows NHS/SNHS members to set their availability times in advance and students to sign up for tutoring to dates that are convenient for them. 
<br>
This website is also used to organize and store student service hours and project information. (Project in this definition means anything that helps yield service hours for students)
</p>

<h3>Here is the main page.</h3>

![alt text](https://github.com/NickDST/nhsdb/blob/master/github_pics/homepage.png)

<br/>
<h3>Here is the NHS/SNHS Hub after they log in.</h3>

![alt text](https://github.com/NickDST/nhsdb/blob/master/github_pics/hubpage.png)

<br/>
<h3>Here is where students set times where they are available to tutor.</h3>

![alt text](https://github.com/NickDST/nhsdb/blob/master/github_pics/availability.png)

<br/>
<h3>NHS/SNHS members can also designate fields/subjects they are willing to tutor in.</h3>

![alt text](https://github.com/NickDST/nhsdb/blob/master/github_pics/set_tutor_fields.png)

<br/>
<h3>When several members log in their times, the calendar will fill up. Requestors can log in on their account and choose a field/subject, then select tutors from their side. </h3>

<br/>
<h3>When several members log in their times, the calendar will fill up. </h3>

![alt text](https://github.com/NickDST/nhsdb/blob/master/github_pics/calendar.png)

<br/>
<h3>Projects and service hours can be entered and stored.</h3>

![alt text](https://github.com/NickDST/nhsdb/blob/master/github_pics/adding_self_to_project.png)

![alt text](https://github.com/NickDST/nhsdb/blob/master/github_pics/project_info.png)

<br>
<h3>Extra Notes</h3>

<br>
So how this website functions is that there are really two different logins: one for tutors/NHS/SNHS members, another one for the person who is looking to be tutored (we dub this person the requestor). For discussion purposes tutors means NHS/SNHS members who are in the system and are willing to tutor.

<strong>MAIN IDEA SUMMARY: </strong>

The main idea with this website is that it flips the conventional tutor and requestor matching process by having the NHS/SNHS members designate times that they are free because between the requestors and tutors, the requestors are more flexible in general to the incredibly busy tutors. Thus, the tutors will set times they are open and the subjects they are willing to tutor in and the requestors will choose from a generated list showed on a calendar.

<strong>SYSTEM MAILING: </strong>

The system sends emails using the phpmail() function between people to keep them notified. Although this is basically spam, the alternative of using other libraries(?) such as PHPMAILER is currently too much of a hassle to set up today. Emails are sent when any of these things happen:

EDIT: Ok so all the emails stopped working after we've added an SSL certificate and now we can't even send spam. So I actually had to go through the hassle to set up a phpmailer and everything is so bleh. I really just copied and pasted the phpmailer code for where the mail() function would have been. How to make ur code look longer for higher payraise 101. Jk I dont get paid. Anyway the emails should send through tutors@concordiashanghai.org now.

A tutor signs up. An email is sent to check if the mailbox sorts it to spam.
2.Requestor registers. An email is sent to check if the mailbox sorts the sent email to spam. Also sends to NHS officers.

When a requestor selects a person they want to tutor them from the tutorrequest.php page. Emails are sent to NHS officers, the tutor (asking them to log in to 'accept/activate' the request, and the requestor.

When a tutor accepts the requestor request from their side, emails are sent to NHS officers, tutor, and requestor saying the event has been verified.

When the requestor verifies the tutoring event from their side, the tutor gets an email saying they have gained X number of hours for tutoring.

If someone creates a project, certain NHS officers are instantly emailed.

Last case would be a 'need help?' Contact form. This has NOT been implemented yet.

<strong>HOW THE SYSTEM WORKS </strong>

The tutor login associates everything based on a student's ID number such as 2019108 (mine). This is because all student IDs are easy to remember for each student and are unique, no student ID number is the same.

This, the names, info, EVERYTHING queried for each person is from the studentid SESSION that stores the value of the student ID. Every page makes sure this session is active (activated by logged in) otherwise the user is redirected to the login page.

An example of loading student information would look like the SQL command "SELECT * FROM students WHERE studentid= '$studentid';

This would load up all the personal information for that student.

Students do not create their own student ID when registering. Their information has to already exist in the "students" table in order for them to be able to create their account to log into.

<strong>SECURITY NUTSHELL: </strong>

This website as for right now uses procedural PHP. As much as I wish I used node.js or Object orientated PHP, right now my skills are only sufficient in procedural PHP and for this relatively small application procedural works fine. If someone SQL injects and hacks oh no......service hours are gone not really.

I use mysqli_real_escape_strings for every field input which takes out special characters such as : ; ( ) $ & / -. This prevents very simple DROP TABLE injections from 7th graders getting through. There is a way to bypass this using very complex and high level SQL injections, but :/

<strong >MY CODING STRUCTURE + SQL </strong>

As mentioned before, I use procedural php for majority of this website (the calendar is javascript from an open source called Fullcalendar).

Most of the stuff should be read from top down like conventional Procedural. But I set my variables and generally the PHP in order for how the page is run.

Otherwise the PHP is all in the beginning or at the end for forms sometimes.

For login pages, almost all of them reference "hubheader.php" or "requesthubheader.php" or "adminhubheader.php" for all the sidebar, database connection, and making sure the user is logged in otherwise redirect them.

I do a lot of SQL queries using mysqli. Almost all the functionality and adding and removing and querying looks something similar to this:

The typical syntax is:

$sql = "SELECT * FROM TABLE WHERE COLUMN = 'some conduction or variable'"

result = mysqli_query($connection, $sql)

While( $row = mysqli_fetch_assoc($result){

Echo row["column"];

}

If you're familiar with this then great! That's the main gist of how the website functionality works.

If you aren't familiar, here is an attempted basic rundown. It's really not complicated.

The first line just stores the command in a string in the variable $sql. The SELECT is selecting/choosing out of * which means all for specified table.

Second line takes your command and executed it. The $connection was specified somewhere earlier but it's basically the connection to the database in a different file.

I believe that the data is stored in a matrix in $result because there might have been multiple rows that came out.

Just...imagine $result stores an excel table with the command we searched. The command could've been WHERE age >10 where we'd get a table stored in $result for those conditions.

We need to do something to this first before we can use it. How do we just get one value out?

To actually get the values we want out, we have to do this third line, which is a while loop for fetching the data from request.
Just imagine that it unstacks the table in $result and runs through only each row.

It loops through each row of the table.

Now if we specified a column, it would loop to shoot out all the values for that column because it's looping through each row.

You pull out what u want by referencing the column. Echo just means print.
So it might be like:

Echo $row["name"]

And come out with:

Nicholas Ho

If you want to add or delete or update with SQL just look up the syntax online and swap the command with that.



Credits
<hr>


Expanding Columns - Ettrics (https://codepen.io/ettrics/pen/ZYqKGb) <br>
Full Calendar - (https://github.com/fullcalendar/fullcalendar) <br>
Creative Tim (MIT License) - (https://www.creative-tim.com/product/light-bootstrap-dashboard)





