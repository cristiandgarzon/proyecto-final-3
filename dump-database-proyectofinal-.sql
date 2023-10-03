-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: proyectofinal
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `almnos_materias`
--

DROP TABLE IF EXISTS `almnos_materias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `almnos_materias` (
  `am_id` int(11) NOT NULL AUTO_INCREMENT,
  `alumno_id` int(11) DEFAULT NULL,
  `materia_id` int(11) DEFAULT NULL,
  `calificacion` float DEFAULT NULL,
  `mensaje` text DEFAULT NULL,
  PRIMARY KEY (`am_id`),
  KEY `alumno_id` (`alumno_id`),
  KEY `materia_id` (`materia_id`),
  CONSTRAINT `almnos_materias_ibfk_1` FOREIGN KEY (`alumno_id`) REFERENCES `usuarios` (`usuario_id`),
  CONSTRAINT `almnos_materias_ibfk_2` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`materia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `almnos_materias`
--

LOCK TABLES `almnos_materias` WRITE;
/*!40000 ALTER TABLE `almnos_materias` DISABLE KEYS */;
INSERT INTO `almnos_materias` VALUES (5,9,3,NULL,NULL),(6,9,7,NULL,NULL),(7,3,7,NULL,NULL),(8,10,7,NULL,NULL),(9,11,7,NULL,NULL),(10,14,7,NULL,NULL),(18,14,8,NULL,NULL),(19,14,33,NULL,NULL),(21,14,3,NULL,NULL);
/*!40000 ALTER TABLE `almnos_materias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maestros_materias`
--

DROP TABLE IF EXISTS `maestros_materias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `maestros_materias` (
  `mm_id` int(11) NOT NULL AUTO_INCREMENT,
  `maestro_id` int(11) DEFAULT NULL,
  `materia_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`mm_id`),
  UNIQUE KEY `maestros_materias_un` (`maestro_id`),
  KEY `materia_id` (`materia_id`),
  CONSTRAINT `maestros_materias_ibfk_1` FOREIGN KEY (`maestro_id`) REFERENCES `usuarios` (`usuario_id`),
  CONSTRAINT `maestros_materias_ibfk_2` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`materia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maestros_materias`
--

LOCK TABLES `maestros_materias` WRITE;
/*!40000 ALTER TABLE `maestros_materias` DISABLE KEYS */;
INSERT INTO `maestros_materias` VALUES (4,16,4),(6,19,6),(7,20,8),(8,21,3),(9,18,7);
/*!40000 ALTER TABLE `maestros_materias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materias`
--

DROP TABLE IF EXISTS `materias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materias` (
  `materia_id` int(11) NOT NULL AUTO_INCREMENT,
  `materia_nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`materia_id`),
  UNIQUE KEY `materias_un` (`materia_nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materias`
--

LOCK TABLES `materias` WRITE;
/*!40000 ALTER TABLE `materias` DISABLE KEYS */;
INSERT INTO `materias` VALUES (8,'Calculo'),(6,'Contabilidad'),(33,'Español '),(9,'Estadistica'),(3,'Filosofia'),(7,'Fisica 2'),(31,'Ingles'),(2,'Literatura'),(4,'programación'),(5,'Psicologia');
/*!40000 ALTER TABLE `materias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `rol_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_nombre` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin'),(2,'Maestro'),(3,'Alumno');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `correo` varchar(250) DEFAULT NULL,
  `contrasena` varchar(250) NOT NULL,
  `usuario_nombre` varchar(150) DEFAULT NULL,
  `fecha_nacimientgo` date DEFAULT NULL,
  `direccion` varchar(250) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `usuario_dni` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`usuario_id`),
  UNIQUE KEY `correo` (`correo`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`rol_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'admin@admin','$2y$10$9f/KqabJ8yTVdFSErHK6meF/psH54wKxMAzkAXcG4EzRcjwBs1VsC','Administrador',NULL,NULL,1,NULL),(3,'alumno@alumno','$2y$10$Gcbh1H37CJbWdxUyZt72nOghCvCoN1iN3u1uUhdEh3on/CRlknTGW','Usuario de prueba','2023-09-28','cra 102 # 57-07 sur',3,65841981521),(9,'camila@camila','$2y$10$WJjbnSX3Ro4PMHzI72wlme7RxT4ThlwX.wAvzUTOpre54oRfprTPO','Camila G','1998-06-06','Calle 2 ##93d-66',3,9854954657685),(10,'Hernesto@alumno','$2y$10$vVsrdNqWf0gq0BwU2FAJ1u3aPzzWdxFKLzEu8n9HK91Aib/kjpAdu','Hernesto g','1991-08-30','Calle falsa #123',3,546465498452),(11,'lalala@lalala','$2y$10$ZpMjHeSLqHLAXP/7YFS1cerOHY.S2L.KbRTd7nZRRKJmcbdQFrSM6','lady Gaga','1978-12-31','los angeles viejos #2',3,354198546686),(14,'matilda@matilda','$2y$10$xRfKSI1VxtktJo/SAP7Dieh7sb5MSd1NIxRjdYnos3osQX9s2.EoG','Matilda Wormwood','2018-08-17','Casa Bonita 459',3,111111111111111),(16,'apachurrados@apachurrados','$2y$10$F4rWg2snGIUIc3h3FidmhOtyobp7fcDfCHnoRWgZluvcvOGuwZZYm','Troncha Toro','1900-04-27','casa robada# 123',2,NULL),(18,'maestro@maestro','$2y$10$KTq9sIF5dflBhNjoQVxNB.Bz6rGNyL9roFOwgQ5oYU7TTiUy9x1Ti','Cambiando el nombre','2020-05-30','sin casa  321',2,0),(19,'miel@miel','$2y$10$7PQUdo2uK.t/yw.4D.gDxef6vfU0KZhCcY8D/oDDJfyEhGoqHGnm6','Señorita miel','1900-04-27','cabañita 123',2,NULL),(20,'utonio@utonio','$2y$10$5NMMjlX7LzDRwk3hEgR.o.kK1j2zDPdDTRy8Z6enznDFN2i8sw3n6','Profesor utonio','2000-12-31','saltadilla 123',2,NULL),(21,'Rasputin@rasputin','$2y$10$nDyp7owjorPbrWKkG1uQce44Kw08NiAvQRtBmwC6J/d2XMl4y2dXS','Raspuntin','1900-04-27','casa robada# 123',2,NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'proyectofinal'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-03 12:33:09
