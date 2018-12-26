-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.1.37-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.4.0.5125
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
  `remetente_documento` varchar(255) DEFAULT NULL,
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

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela scpd.hierarquia_orgao
CREATE TABLE IF NOT EXISTS `hierarquia_orgao` (
  `id_hierarquia_orgao` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_hierarquia` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_hierarquia_orgao`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
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
  `data_movimento` datetime DEFAULT NULL,
  `id_orgao` int(11) DEFAULT NULL,
  `observacoes` longtext,
  PRIMARY KEY (`id_movimento`),
  KEY `id_orgao` (`id_orgao`),
  KEY `id_processo_documento` (`id_processo_documento`),
  KEY `id_tipo_movimento` (`id_tipo_movimento`),
  CONSTRAINT `movimento_ibfk_1` FOREIGN KEY (`id_orgao`) REFERENCES `orgao` (`id_orgao`),
  CONSTRAINT `movimento_ibfk_2` FOREIGN KEY (`id_processo_documento`) REFERENCES `processo_documento` (`id_processo_documento`),
  CONSTRAINT `movimento_ibfk_3` FOREIGN KEY (`id_tipo_movimento`) REFERENCES `tipo_movimento` (`id_tipo_movimento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela scpd.nivel_usuario
CREATE TABLE IF NOT EXISTS `nivel_usuario` (
  `id_nivel_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nivel` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_nivel_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela scpd.orgao
CREATE TABLE IF NOT EXISTS `orgao` (
  `id_orgao` int(11) NOT NULL AUTO_INCREMENT,
  `nome_orgao` varchar(100) DEFAULT NULL,
  `id_hierarquia_orgao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_orgao`),
  KEY `id_hierarquia_orgao` (`id_hierarquia_orgao`),
  CONSTRAINT `orgao_ibfk_1` FOREIGN KEY (`id_hierarquia_orgao`) REFERENCES `hierarquia_orgao` (`id_hierarquia_orgao`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela scpd.processo_documento
CREATE TABLE IF NOT EXISTS `processo_documento` (
  `id_processo_documento` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_processo_documento` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_processo_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela scpd.situacao_usuario
CREATE TABLE IF NOT EXISTS `situacao_usuario` (
  `id_situacao_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `situacao` varchar(20) NOT NULL,
  PRIMARY KEY (`id_situacao_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela scpd.tipo_documento
CREATE TABLE IF NOT EXISTS `tipo_documento` (
  `id_tipo_documento` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_documento` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_documento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela scpd.tipo_movimento
CREATE TABLE IF NOT EXISTS `tipo_movimento` (
  `id_tipo_movimento` int(11) NOT NULL,
  `tipo_movimento` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_movimento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
-- Copiando estrutura para tabela scpd.tipo_processo
CREATE TABLE IF NOT EXISTS `tipo_processo` (
  `id_tipo_processo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_processo` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_processo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.
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

-- Exportação de dados foi desmarcado.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
