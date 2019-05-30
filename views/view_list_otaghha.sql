SELECT m1.*
FROM tcoding AS m1
INNER JOIN tcoding AS m2 ON m1.id_p1 = m2.id AND m2.deleted = 0 AND m2.id_noe = 1
WHERE m1.id_noe = 2 AND m1.deleted = 0 AND m1.valint5 = 1