-- 2 Создать роль developers с правами на создание баз данных и без возможности
-- создавать роли
CREATE ROLE developers WITH CREATEDB NOCREATEROLE;
-- 3 Создать роль managers без возможности создавать роли и базы данных.
CREATE ROLE managers NOSUPERUSER NOCREATEDB NOCREATEROLE;
-- 4 Создать по пользователю для каждой роли.
CREATE USER developer WITH PASSWORD '11' CREATEDB;
CREATE USER manager WITH PASSWORD '11' NOCREATEDB NOCREATEROLE;
-- 5 Создать пустую базу данных pizza
CREATE DATABASE pizza_chuloshnikov_m_b;
