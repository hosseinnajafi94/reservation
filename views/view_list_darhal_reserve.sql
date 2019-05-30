SELECT m1.id, id_p2 AS id_p1, m1.date1, m1.date2, m1.datetime1
FROM reservations AS m1
WHERE m1.id_p1 = 15