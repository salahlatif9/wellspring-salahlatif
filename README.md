# wellspring-salahlatif

In order for this application to work properly, please follow the following steps:

-------
if you are using XAMPP copy and past these files in htdocs folder which you can find it in the path you installed XAMPP
-------

When you try to add any data, any row missing a single data will be eliminated 

In order to add data, you need to upload a csv file. The file should have 4 rows with exact titles. Similar to the following:
 
TRAIN_LINE	 ROUTE_NAME	 RUN_NUMBER	 OPERATOR_ID

After uploading the file, click Upload button and then click Show Data button. The data will be displayed sorted by RUN_NUMBER

------------------------------------------------

In order to delete data, you need to upload a csv file. The file should have 4 rows with exact titles. Similar to the following:
 
TRAIN_LINE	 ROUTE_NAME	 RUN_NUMBER	 OPERATOR_ID

After uploading the file, click delete button and then click Show Data button. The remaining data will be displayed sorted by RUN_NUMBER

--------------------------------------------------

In order to sort the data with any column, simply click on the column. 
The displayed data will only show 5 rows at a time. To view more data, please click on the page number located underneath. 
The page number will contain 2 values: the page number and the column the table was sorted based on. 

-----------------------


database configuration:

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "wellspring";


