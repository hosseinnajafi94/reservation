SELECT m1.*
FROM view_list_otaghha AS m1
WHERE m1.id NOT IN (
	      SELECT m2.id_p1 FROM view_list_darhal_reserve AS m2 WHERE (m2.date1 <= '2019-04-24' AND m2.date2 >= '2019-04-24') OR (m2.date1 < '2019-04-26' AND m2.date2 >= '2019-04-26') OR ('2019-04-24' <= m2.date1 AND '2019-04-26' >= m2.date1)
	UNION SELECT m3.id_p1 FROM view_list_reserv_shodeha AS m3 WHERE (m3.date1 <= '2019-04-24' AND m3.date2 >= '2019-04-24') OR (m3.date1 < '2019-04-26' AND m3.date2 >= '2019-04-26') OR ('2019-04-24' <= m3.date1 AND '2019-04-26' >= m3.date1)
	UNION SELECT m4.id_p1 FROM view_list_ghoflha        AS m4 WHERE (m4.date1 <= '2019-04-24' AND m4.date2 >= '2019-04-24') OR (m4.date1 < '2019-04-26' AND m4.date2 >= '2019-04-26') OR ('2019-04-24' <= m4.date1 AND '2019-04-26' >= m4.date1)
)