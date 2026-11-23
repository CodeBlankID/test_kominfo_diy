-- TUGAS 3 QUERY

-- 1
select extract (EPOCH from (end_time::timestamp - start_time::timestamp )) as total_hours,b.room_id ,b.name from bookings b where b.status = 'CONFIRMED'
-- 2
select * from rooms r inner join bookings b on r.id = b.room_id  where r.is_active = true and b.status != 'CONFIRMED' and ( start_time >= '2026-11-23' AND start_time <=  '2026-11-23')

