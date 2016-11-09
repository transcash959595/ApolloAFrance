DROP PROCEDURE IF EXISTS france.loadingdetailednew;
CREATE PROCEDURE france.`loadingdetailednew`(datestart varchar(15) ,todate varchar(15))
BEGIN
DECLARE startdate VARCHAR(15);
DECLARE enddate VARCHAR(15);
DECLARE newstartdate VARCHAR(15);
DECLARE newenddate VARCHAR(15);
TRUNCATE `revenueload`;
SET startdate   = datestart;
# SET enddate  = DATE_ADD(startdate, INTERVAL -1 DAY);
SET enddate  = LAST_DAY(startdate);
#SET enddate = todate;
WHILE startdate <= todate DO 

SET newstartdate = Date_Format(startdate,'%m/%d/%Y');
SET newenddate = Date_Format(enddate,'%m/%d/%Y');

INSERT into `revenueload` 
SELECT ( 
SELECT CONCAT(newstartdate,'-',newenddate) )AS 'DATERANGE' ,
(
SELECT COUNT(*)
FROM `loadingnew` 
WHERE `Description` = 'Voucher'
AND `Req_code` = '20.00'
AND `Date` >= newstartdate
AND `Date` <= newenddate ) AS 'V20',

(

SELECT SUM(  `credit` ) 
FROM  `loadingnew` 
WHERE  `Description` =  'Voucher'
AND  `Req_code` =  '20.00'
AND  `Date` >=  newstartdate
AND  `Date` <=  newenddate
) AS  'sum20',


(

SELECT COUNT( * ) 
FROM  `loadingnew` 
WHERE  `Description` =  'Voucher'
AND  `Req_code` =  '50.00'
AND  `Date` >=  newstartdate
AND  `Date` <=  newenddate
) AS  'v50', 

(   


SELECT SUM(  `credit` ) 
FROM  `loadingnew` 
WHERE  `Description` =  'Voucher'
AND  `Req_code` =  '50.00'
AND  `Date` >=  newstartdate
AND  `Date` <=  newenddate
) AS  'sum50',

(    
 
SELECT COUNT( * ) 
FROM  `loadingnew` 
WHERE  `Description` =  'Voucher'
AND  `Req_code` =  '100.00'
AND  `Date` >=  newstartdate
AND  `Date` <=  newenddate
) AS  'v100' ,  

(  

SELECT SUM(  `credit` ) 
FROM  `loadingnew` 
WHERE  `Description` =  'Voucher'
AND  `Req_code` =  '100.00'
AND  `Date` >=  newstartdate
AND  `Date` <=  newenddate
) AS  'sum100', 

(     

SELECT COUNT( * ) 
FROM  `loadingnew` 
WHERE  `Description` =  'Voucher'
AND  `Req_code` =  '150.00'
AND  `Date` >=  newstartdate
AND  `Date` <=  newenddate
) AS  'v150',  

(   

SELECT SUM(  `credit` ) 
FROM  `loadingnew` 
WHERE  `Description` =  'Voucher'
AND  `Req_code` =  '150.00'
AND  `Date` >=  newstartdate
AND  `Date` <=  newenddate
) AS  'sum150', 

(     

SELECT COUNT( * ) 
FROM  `loadingnew` 
WHERE  `Description` =  'Voucher'
AND  `Req_code` =  '200.00'
AND  `Date` >=  newstartdate
AND  `Date` <=  newenddate
) AS  'v200' ,

(    

SELECT SUM(  `credit` ) 
FROM  `loadingnew` 
WHERE  `Description` =  'Voucher'
AND  `Req_code` =  '200.00'
AND  `Date` >=  newstartdate
AND  `Date` <=  newenddate
) AS  'sum200', 

(       


SELECT COUNT( * ) 
FROM  `loadingnew` 
WHERE  `Description` =  'Voucher'
AND  `Req_code` =  '300.00'
AND  `Date` >=  newstartdate
AND  `Date` <=  newenddate
) AS  'v300'  ,  

(  

SELECT SUM(  `credit` ) 
FROM  `loadingnew` 
WHERE  `Description` =  'Voucher'
AND  `Req_code` =  '300.00'
AND  `Date` >=  newstartdate
AND  `Date` <=  newenddate
) AS  'sum300' , 

(    


SELECT COUNT( * ) 
FROM  `loadingnew` 
WHERE  `Description` =  'Voucher'
AND  `Req_code` =  '500.00'
AND  `Date` >=  newstartdate
AND  `Date` <=  newenddate
) AS  'v500'  ,  

(  

SELECT SUM(  `credit` ) 
FROM  `loadingnew` 
WHERE  `Description` =  'Voucher'
AND  `Req_code` =  '500.00'
AND  `Date` >=  newstartdate
AND  `Date` <=  newenddate
) AS  'sum500' , 

(   


SELECT COUNT( * ) 
FROM  `loadingnew` 
WHERE  `Description` =  'Bank Transfer'
AND  `Date` >=  newstartdate
AND  `Date` <=  newenddate
) AS  'nobktrn'  , 

( 

SELECT SUM(  `credit` ) 
FROM  `loadingnew` 
WHERE  `Description` =  'Bank Transfer'

AND  `Date` >=  newstartdate
AND  `Date` <=  newenddate
) AS  'sumbktrn' , 

(   

SELECT COUNT( * ) 
FROM  `loadingnew` 
WHERE  `Description` =  'Credit Card'

AND  `Date` >=  newstartdate
AND  `Date` <=  newenddate
) AS  'creditcard'  , 

(  
SELECT SUM(  `credit` ) 
FROM  `loadingnew` 
WHERE  `Description` =  'Credit Card'

AND  `Date` >=  newstartdate
AND  `Date` <=  newenddate
) AS  'sumcreditcard';


#select concat('startdate is ', newstartdate);
#select concat('enddate is ', newenddate);





SET startdate  = DATE_ADD(startdate, INTERVAL 1 MONTH);

SET enddate  = LAST_DAY(startdate);


SET newstartdate = Date_Format(startdate,'%m/%d/%Y');
SET newenddate = Date_Format(enddate,'%m/%d/%Y');



END WHILE;
	
END;
