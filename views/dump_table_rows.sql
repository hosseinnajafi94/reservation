SELECT CAST(NOW() AS date) AS name1, CAST(NOW() AS time) AS valint1
UNION
SELECT name1, valint1 FROM (
	SELECT TABLE_NAME AS name1, SUM(TABLE_ROWS) AS valint1
	FROM INFORMATION_SCHEMA.TABLES 
	WHERE TABLE_SCHEMA = 'reservation' AND TABLE_TYPE = 'BASE TABLE'
	GROUP BY TABLE_NAME
	ORDER BY 2 DESC
) AS m1



SET @@session.time_zone = 'SYSTEM';
SET global time_zone = 'SYSTEM';
SET time_zone = 'SYSTEM';
-- SET time_zone = '+4:30';
select now();
SELECT @@session.time_zone;
SELECT @@global.time_zone;
SELECT @@time_zone;