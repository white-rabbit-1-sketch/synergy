-- 1 посмотреть как работают запросы на просмотр таблиц, колонок и Т.Д.
SELECT table_name
FROM information_schema.tables
WHERE table_schema = 'public';

SELECT column_name, data_type
FROM information_schema.columns
WHERE table_name = 'customers';

SELECT usename
FROM pg_user;

-- 2 написать запрос для просмотра процессов дольше 5 минут
SELECT pid,
       now() - pg_stat_activity.query_start AS duration,
       pg_stat_activity.query
FROM pg_stat_activity
WHERE state = 'active'
  AND now() - pg_stat_activity.query_start > interval '5 minutes';
