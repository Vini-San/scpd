-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.37-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para scpd
CREATE DATABASE IF NOT EXISTS `scpd` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `scpd`;

-- Copiando estrutura para tabela scpd.documento
CREATE TABLE IF NOT EXISTS `documento` (
  `id_documento` int(11) NOT NULL AUTO_INCREMENT,
  `numero_documento` varchar(250) NOT NULL,
  `id_orgao` int(11) DEFAULT NULL,
  `id_tipo_documento` int(11) DEFAULT NULL,
  `data_inicio` datetime DEFAULT NULL,
  `nome_documento` varchar(255) DEFAULT NULL,
  `assunto_documento` varchar(255) DEFAULT NULL,
  `id_processo_documento` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_documento`),
  KEY `id_orgao` (`id_orgao`),
  KEY `id_tipo_documento` (`id_tipo_documento`),
  KEY `id_processo_documento` (`id_processo_documento`),
  CONSTRAINT `documento_ibfk_1` FOREIGN KEY (`id_orgao`) REFERENCES `orgao` (`id_orgao`),
  CONSTRAINT `documento_ibfk_2` FOREIGN KEY (`id_tipo_documento`) REFERENCES `tipo_documento` (`id_tipo_documento`),
  CONSTRAINT `documento_ibfk_3` FOREIGN KEY (`id_processo_documento`) REFERENCES `processo_documento` (`id_processo_documento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela scpd.documento: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `documento` DISABLE KEYS */;
/*!40000 ALTER TABLE `documento` ENABLE KEYS */;

-- Copiando estrutura para tabela scpd.hierarquia_orgao
CREATE TABLE IF NOT EXISTS `hierarquia_orgao` (
  `id_hierarquia_orgao` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_hierarquia` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_hierarquia_orgao`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela scpd.hierarquia_orgao: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `hierarquia_orgao` DISABLE KEYS */;
INSERT INTO `hierarquia_orgao` (`id_hierarquia_orgao`, `tipo_hierarquia`) VALUES
	(1, 'interno'),
	(2, 'externo');
/*!40000 ALTER TABLE `hierarquia_orgao` ENABLE KEYS */;

-- Copiando estrutura para função scpd.logar
DELIMITER //
CREATE DEFINER=`root`@`localhost` FUNCTION `logar`(pcpf varchar(11), psenha varchar(200)) RETURNS varchar(100) CHARSET latin1
begin

declare vid int;

declare vtentar1 int;

declare vtentar2 int;

select count(*), tentativa into vid, vtentar1 from usuario where cpf = pcpf;

if vid = 0 then

	return 'Usuario ou senha inválido';

	else

		if vtentar1 > 2 then

		return 'Usuario bloqueado';

		else

		select id_usuario, count(*) into vid, vtentar2 from usuario where cpf = pcpf and senha = psenha;

		if vid is null then

		update usuario set tentativa = vtentar1 + 1 where cpf = pcpf;

		return 'Usuario ou senha inválido';

			else

			update usuario set tentativa = 0 where cpf = pcpf;

			return 'Logado';

			end if;

		end if;

end if;

end//
DELIMITER ;

-- Copiando estrutura para tabela scpd.movimento
CREATE TABLE IF NOT EXISTS `movimento` (
  `id_movimento` int(11) NOT NULL AUTO_INCREMENT,
  `id_processo_documento` int(11) DEFAULT NULL,
  `id_tipo_movimento` int(11) DEFAULT NULL,
  `proc_data_entrada` datetime DEFAULT NULL,
  `id_orgao` int(11) DEFAULT NULL,
  `observacoes_proc_entrada` longtext,
  PRIMARY KEY (`id_movimento`),
  KEY `id_orgao` (`id_orgao`),
  KEY `id_processo_documento` (`id_processo_documento`),
  KEY `id_tipo_movimento` (`id_tipo_movimento`),
  CONSTRAINT `movimento_ibfk_1` FOREIGN KEY (`id_orgao`) REFERENCES `orgao` (`id_orgao`),
  CONSTRAINT `movimento_ibfk_2` FOREIGN KEY (`id_processo_documento`) REFERENCES `processo_documento` (`id_processo_documento`),
  CONSTRAINT `movimento_ibfk_3` FOREIGN KEY (`id_tipo_movimento`) REFERENCES `tipo_movimento` (`id_tipo_movimento`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela scpd.movimento: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `movimento` DISABLE KEYS */;
INSERT INTO `movimento` (`id_movimento`, `id_processo_documento`, `id_tipo_movimento`, `proc_data_entrada`, `id_orgao`, `observacoes_proc_entrada`) VALUES
	(1, 8, 1, '2018-12-20 00:00:00', 5, 'recebido nesta data'),
	(2, 9, 1, '2018-12-27 00:00:00', 5, 'recebido nesta data'),
	(6, 13, 1, '2018-12-27 00:00:00', 2, 'recebido nesta data'),
	(8, 15, 1, '2018-12-27 00:00:00', 5, 'processo recebido'),
	(9, 16, 1, '2018-12-27 00:00:00', 1, 'processo recebido');
/*!40000 ALTER TABLE `movimento` ENABLE KEYS */;

-- Copiando estrutura para tabela scpd.nivel_usuario
CREATE TABLE IF NOT EXISTS `nivel_usuario` (
  `id_nivel_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nivel` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_nivel_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela scpd.nivel_usuario: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `nivel_usuario` DISABLE KEYS */;
INSERT INTO `nivel_usuario` (`id_nivel_usuario`, `nivel`) VALUES
	(1, 'administrador'),
	(2, 'usuario');
/*!40000 ALTER TABLE `nivel_usuario` ENABLE KEYS */;

-- Copiando estrutura para tabela scpd.orgao
CREATE TABLE IF NOT EXISTS `orgao` (
  `id_orgao` int(11) NOT NULL AUTO_INCREMENT,
  `nome_orgao` varchar(100) DEFAULT NULL,
  `id_hierarquia_orgao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_orgao`),
  KEY `id_hierarquia_orgao` (`id_hierarquia_orgao`),
  CONSTRAINT `orgao_ibfk_1` FOREIGN KEY (`id_hierarquia_orgao`) REFERENCES `hierarquia_orgao` (`id_hierarquia_orgao`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela scpd.orgao: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `orgao` DISABLE KEYS */;
INSERT INTO `orgao` (`id_orgao`, `nome_orgao`, `id_hierarquia_orgao`) VALUES
	(1, 'DGI', 1),
	(2, 'SEEDUC', 2),
	(3, 'TJRJ', 2),
	(4, 'CVT Campinho', 1),
	(5, 'SECPRES', 1);
/*!40000 ALTER TABLE `orgao` ENABLE KEYS */;

-- Copiando estrutura para tabela scpd.processo
CREATE TABLE IF NOT EXISTS `processo` (
  `id_processo` int(11) NOT NULL AUTO_INCREMENT,
  `numero_processo` varchar(250) NOT NULL,
  `id_orgao` int(11) DEFAULT NULL,
  `id_tipo_processo` int(11) DEFAULT NULL,
  `data_inicio` datetime DEFAULT NULL,
  `nome_processo` varchar(255) DEFAULT NULL,
  `assunto_processo` varchar(255) DEFAULT NULL,
  `id_processo_documento` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_processo`),
  KEY `id_orgao` (`id_orgao`),
  KEY `id_tipo_processo` (`id_tipo_processo`),
  KEY `id_processo_documento` (`id_processo_documento`),
  CONSTRAINT `processo_ibfk_1` FOREIGN KEY (`id_orgao`) REFERENCES `orgao` (`id_orgao`),
  CONSTRAINT `processo_ibfk_2` FOREIGN KEY (`id_tipo_processo`) REFERENCES `tipo_processo` (`id_tipo_processo`),
  CONSTRAINT `processo_ibfk_3` FOREIGN KEY (`id_processo_documento`) REFERENCES `processo_documento` (`id_processo_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela scpd.processo: ~18 rows (aproximadamente)
/*!40000 ALTER TABLE `processo` DISABLE KEYS */;
INSERT INTO `processo` (`id_processo`, `numero_processo`, `id_orgao`, `id_tipo_processo`, `data_inicio`, `nome_processo`, `assunto_processo`, `id_processo_documento`) VALUES
	(1, 'wcr3456', 4, 1, '2017-10-25 00:00:00', 'joão das couves', 'Processo em andamento no CVT', 1),
	(2, 'aci954567', 3, 2, '2017-08-29 00:00:00', 'maria', 'Processo derivado do TJ', 1),
	(3, 'proc567', 2, 3, '2015-05-12 09:59:43', 'teste', 'assuntoteste', 1),
	(4, 'ACI/5256', 1, 1, '2018-01-24 00:00:00', 'teste2', 'assuntotestedois', 1),
	(5, 'Proc/53178', 2, 2, '2017-10-28 00:00:00', 'JosÃ©', 'Processo Externo', 1),
	(6, 'num9876465', 2, 3, '2011-08-15 00:00:00', 'thales', 'Furto de equipamento do Faeterj', 1),
	(7, 'wcr3456', 4, 1, '2016-06-14 00:00:00', 'joão das couves', 'Processo em andamento no CVT', 4),
	(8, 'Proc/3456', 3, 1, '2013-05-14 01:00:00', 'maria', 'Processo Externo do Tribunal de JustiÃ§a', 6),
	(9, 'ACI/2584', 4, 1, '2017-04-21 00:00:00', 'teste', 'retificação de ponto', 7),
	(10, 'ACI/2584', 4, 1, '2017-04-21 00:00:00', 'teste', 'retificação de ponto', 8),
	(11, 'ACI/7564', 3, 1, '2013-10-08 00:00:00', 'maisteste', 'processo disciplinar', 9),
	(12, 'ACI/5254', 2, 1, '2017-10-28 00:00:00', 'testepg', 'assuntotestepg', 10),
	(13, 'ACI/5432', 3, 2, '2011-08-14 00:00:00', 'testepg2', 'assuntotestepg2', 11),
	(14, 'ACI/5353', 4, 2, '2017-08-30 00:00:00', 'testepg3', 'assuntotestepg3', 12),
	(15, 'ACI/7834', 2, 1, '2016-11-28 00:00:00', 'outroteste', 'processo disciplinar', 13),
	(16, 'Proc/9874', 4, 3, '2011-08-10 00:00:00', 'teste47', 'assuntoteste', 14),
	(17, 'Proc/53178', 3, 2, '2018-01-24 00:00:00', 'testepg', 'Processo Externo', 15),
	(18, 'ACI/8476', 2, 1, '2017-10-28 00:00:00', 'teste65', 'Processo SEEDUC', 16);
/*!40000 ALTER TABLE `processo` ENABLE KEYS */;

-- Copiando estrutura para tabela scpd.processo_documento
CREATE TABLE IF NOT EXISTS `processo_documento` (
  `id_processo_documento` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_processo_documento` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_processo_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela scpd.processo_documento: ~16 rows (aproximadamente)
/*!40000 ALTER TABLE `processo_documento` DISABLE KEYS */;
INSERT INTO `processo_documento` (`id_processo_documento`, `tipo_processo_documento`) VALUES
	(1, 'processo'),
	(2, 'documento'),
	(3, 'processo'),
	(4, 'processo'),
	(5, 'processo'),
	(6, 'processo'),
	(7, 'processo'),
	(8, 'processo'),
	(9, 'ACI/7564'),
	(10, 'ACI/5254'),
	(11, 'ACI/5432'),
	(12, 'ACI/5353'),
	(13, 'ACI/7834'),
	(14, 'Proc/9874'),
	(15, 'Proc/53178'),
	(16, 'ACI/8476');
/*!40000 ALTER TABLE `processo_documento` ENABLE KEYS */;

-- Copiando estrutura para tabela scpd.situacao_usuario
CREATE TABLE IF NOT EXISTS `situacao_usuario` (
  `id_situacao_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `situacao` varchar(20) NOT NULL,
  PRIMARY KEY (`id_situacao_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela scpd.situacao_usuario: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `situacao_usuario` DISABLE KEYS */;
INSERT INTO `situacao_usuario` (`id_situacao_usuario`, `situacao`) VALUES
	(1, 'inativo'),
	(2, 'ativo');
/*!40000 ALTER TABLE `situacao_usuario` ENABLE KEYS */;

-- Copiando estrutura para tabela scpd.tipo_documento
CREATE TABLE IF NOT EXISTS `tipo_documento` (
  `id_tipo_documento` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_documento` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_documento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela scpd.tipo_documento: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tipo_documento` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_documento` ENABLE KEYS */;

-- Copiando estrutura para tabela scpd.tipo_movimento
CREATE TABLE IF NOT EXISTS `tipo_movimento` (
  `id_tipo_movimento` int(11) NOT NULL,
  `tipo_movimento` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_movimento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela scpd.tipo_movimento: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `tipo_movimento` DISABLE KEYS */;
INSERT INTO `tipo_movimento` (`id_tipo_movimento`, `tipo_movimento`) VALUES
	(1, 'entrada'),
	(2, 'saida');
/*!40000 ALTER TABLE `tipo_movimento` ENABLE KEYS */;

-- Copiando estrutura para tabela scpd.tipo_processo
CREATE TABLE IF NOT EXISTS `tipo_processo` (
  `id_tipo_processo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_processo` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_processo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela scpd.tipo_processo: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `tipo_processo` DISABLE KEYS */;
INSERT INTO `tipo_processo` (`id_tipo_processo`, `tipo_processo`) VALUES
	(1, 'ACI'),
	(2, 'Processo Disciplinar'),
	(3, 'Furto');
/*!40000 ALTER TABLE `tipo_processo` ENABLE KEYS */;

-- Copiando estrutura para tabela scpd.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(200) DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `senha` varchar(250) DEFAULT NULL,
  `tentativa` int(11) DEFAULT NULL,
  `id_orgao` int(11) DEFAULT NULL,
  `id_nivel_usuario` int(11) DEFAULT NULL,
  `id_situacao_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`),
  KEY `id_orgao` (`id_orgao`),
  KEY `id_situacao_usuario` (`id_situacao_usuario`),
  KEY `id_nivel_usuario` (`id_nivel_usuario`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_orgao`) REFERENCES `orgao` (`id_orgao`),
  CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`id_situacao_usuario`) REFERENCES `situacao_usuario` (`id_situacao_usuario`),
  CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`id_nivel_usuario`) REFERENCES `nivel_usuario` (`id_nivel_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela scpd.usuario: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id_usuario`, `nome_usuario`, `cpf`, `email`, `senha`, `tentativa`, `id_orgao`, `id_nivel_usuario`, `id_situacao_usuario`) VALUES
	(1, 'Jose Luiz Garcia', '1234', 'luiz@email.com', '123456', NULL, 1, 1, NULL),
	(2, 'Vinicius dos Santos', 'admin', 'vinicius@email.com', '$2y$12$YlooCyNvyTji8bPRcrfNfOKnVMmZA9ViM2A3IpFjmrpIbp5ovNmga', NULL, 1, 2, NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
