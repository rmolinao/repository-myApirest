-- MariaDB dump 10.17  Distrib 10.4.6-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: apirest
-- ------------------------------------------------------
-- Server version	10.4.6-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `citas`
--

DROP TABLE IF EXISTS `citas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `citas` (
  `CitaId` int(11) NOT NULL AUTO_INCREMENT,
  `PacienteId` varchar(45) DEFAULT NULL,
  `Fecha` varchar(45) DEFAULT NULL,
  `HoraInicio` varchar(45) DEFAULT NULL,
  `HoraFIn` varchar(45) DEFAULT NULL,
  `Estado` varchar(45) DEFAULT NULL,
  `Motivo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`CitaId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citas`
--

LOCK TABLES `citas` WRITE;
/*!40000 ALTER TABLE `citas` DISABLE KEYS */;
INSERT INTO `citas` VALUES (1,'1','2020-06-09','08:30:00','09:00:00','Confirmada','El paciente presenta un leve dolor de espalda'),(2,'2','2020-06-10','08:30:00','09:00:00','Confirmada','Dolor en la zona lumbar '),(3,'3','2020-06-18','09:00:00','09:30:00','Confirmada','Dolor en el cuello');
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pacientes` (
  `PacienteId` int(11) NOT NULL AUTO_INCREMENT,
  `DNI` varchar(45) DEFAULT NULL,
  `Nombre` varchar(150) DEFAULT NULL,
  `Direccion` varchar(45) DEFAULT NULL,
  `CodigoPostal` varchar(45) DEFAULT NULL,
  `Telefono` varchar(45) DEFAULT NULL,
  `Genero` varchar(45) DEFAULT NULL,
  `FechaNacimiento` date DEFAULT NULL,
  `Correo` varchar(45) DEFAULT NULL,
  `Imagen` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`PacienteId`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pacientes`
--

LOCK TABLES `pacientes` WRITE;
/*!40000 ALTER TABLE `pacientes` DISABLE KEYS */;
INSERT INTO `pacientes` VALUES (1,'A000000001','Juan Carlos Medina PUT','Calle de pruebas 1','20001','633281515','M','1989-03-02','Paciente1@gmail.com',NULL),(2,'B000000002','Daniel Rios','Calle de pruebas 2','20002','633281512','M','1990-05-11','Paciente2@gmail.com',NULL),(3,'C000000003','Marcela Dubon','Calle de pruebas 3','20003','633281511','F','2000-07-22','Paciente3@gmail.com',NULL),(4,'D000000004','Maria Mendez','Calle de pruebas 4','20004','633281516','F','1980-01-01','Paciente4@gmail.com',NULL),(5,'E000000005','Zamuel Valladares','Calle de pruebas 5','20006','633281519','M','1985-12-15','Paciente5@gmail.com',NULL),(6,'F000000006','Angel Rios','Calle de pruebas 6','20005','633281510','M','1988-11-30','Paciente6@gmail.com',NULL),(32,'A000000001','Poncho ','Zuleta Martinez','200156','633281515','M','1989-03-02','Ponchogmail.com','D:\\Servers\\xampp\\htdocs\\myProyects\\php\\Talleres\\myApirest\\public\\image\\64a979de8db5e.jpeg'),(34,'A000000001','Poncho ','Zuleta Martinez','200156','633281515','M','1989-03-02','Ponchogmail.com',NULL);
/*!40000 ALTER TABLE `pacientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `UsuarioId` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario` varchar(45) DEFAULT NULL,
  `Password` varchar(45) DEFAULT NULL,
  `Estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`UsuarioId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'usuario1@gmail.com','e10adc3949ba59abbe56e057f20f883e','Activo'),(2,'usuario2@gmail.com','e10adc3949ba59abbe56e057f20f883e','Activo'),(3,'usuario3@gmail.com','e10adc3949ba59abbe56e057f20f883e','Activo'),(4,'usuario4@gmail.com','e10adc3949ba59abbe56e057f20f883e','Activo'),(5,'usuario5@gmail.com','e10adc3949ba59abbe56e057f20f883e','Activo'),(6,'usuario6@gmail.com','e10adc3949ba59abbe56e057f20f883e','Activo'),(7,'usuario7@gmail.com','e10adc3949ba59abbe56e057f20f883e','Inactivo'),(8,'usuario8@gmail.com','e10adc3949ba59abbe56e057f20f883e','Inactivo'),(9,'usuario9@gmail.com','e10adc3949ba59abbe56e057f20f883e','Inactivo');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios_token`
--

DROP TABLE IF EXISTS `usuarios_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios_token` (
  `TokenId` int(11) NOT NULL AUTO_INCREMENT,
  `UsuarioId` varchar(45) DEFAULT NULL,
  `Token` varchar(45) DEFAULT NULL,
  `Estado` varchar(45) CHARACTER SET armscii8 DEFAULT NULL,
  `Fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`TokenId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios_token`
--

LOCK TABLES `usuarios_token` WRITE;
/*!40000 ALTER TABLE `usuarios_token` DISABLE KEYS */;
INSERT INTO `usuarios_token` VALUES (1,'1','556028b82c83c5164b5a00c0ffbbd922','Activo','2023-06-16 04:29:00');
/*!40000 ALTER TABLE `usuarios_token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'apirest'
--

--
-- Dumping routines for database 'apirest'
--
/*!50003 DROP PROCEDURE IF EXISTS `insert_pacientes` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`rmolinao`@`%` PROCEDURE `insert_pacientes`(
									 IN p_dni				varchar(45),
                                     IN p_nombre 			varchar(150),
                                     IN p_direccion 		varchar(45),
									 IN p_codigoPostal 	varchar(45),
									 IN p_telefono 		varchar(45),
									 IN p_genero 			varchar(45),
									 IN p_fechaNacimiento 	date,
									 IN p_correo 			varchar(45),
                                     IN P_imagen			varchar(200),
                                     OUT  p_idPaciente int )
BEGIN
	INSERT INTO
  `apirest`.`pacientes` (
    `DNI`,
    `Nombre`,
    `Direccion`,
    `CodigoPostal`,
    `Telefono`,
    `Genero`,
    `FechaNacimiento`,
    `Correo`,
    `Imagen`
  )
VALUES
  (
    p_dni,
    p_nombre,
    p_direccion,
    p_codigoPostal,
    p_telefono,
    p_genero,
    p_fechaNacimiento,
    p_correo,
    p_imagen
  );
  SELECT  last_insert_id() INTO p_idPaciente;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-07-08 10:33:21
