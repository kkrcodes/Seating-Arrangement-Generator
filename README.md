# Seating-Arrangement-Generator
A web-based seating arrangement generator app made in PHP for generating seating layouts in classrooms and examination halls. Handy for teachers and examination organizers to quickly generate seating layouts. The application can generate layouts for any number of rooms and lists of students.

How it works
------------
<ul>
 <li>The list of rooms available along with the number of rows and columns of benches is listed in <b><i>rooms.txt</i></b>.</li>
 <li>For each list of students to be seated, a textfile containing their roll numbers is created.</li>
 <li>On running <b><i>index.php</i></b>, each list of students are allotted seats parallel to other lists in the rooms available.</li>
 <li>The layout can be printed and displayed outside the examination hall.</li>
</ul>

Pre-requisites
--------------
<ul>
 <li>PHP</li>
 <li>Apache</li>
</ul>

Deployment
----------
<ul>
 <li>Setup the Apache server through XAMPP or a distribution software of your choice.</li>
 <li>Start the apache server.</li>
 <li>Clone the project to your server's default path.</li>
 <li>Run the app on your web browser at <b><i>localhost/Seating-Arrangement-Generator/sage/index.php</i></b>.</li>
 <li>The generated layouts will be displayed.</li>
</ul>

Screenshots
-----------
<img src="screenshots/seating_arrangement.PNG" title="Seating Layouts" alt="Seating Layouts">
  
## License

The content of this repository is licensed under a
[GNU General Public License v3.0](LICENSE).

