SELECT m1.id, m1.id_p1, m2.date1, m2.date2, m2.name1, m2.valint1, m1.valint1 AS valint2
FROM tcoding AS m1
INNER JOIN tcoding AS m2 ON m1.id_p2 = m2.id AND m2.id_noe = 4 AND m2.deleted = 0
WHERE m1.id_noe = 5 AND m1.deleted = 0