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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela scpd.documento: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `documento` DISABLE KEYS */;
INSERT INTO `documento` (`id_documento`, `numero_documento`, `id_orgao`, `id_tipo_documento`, `data_inicio`, `nome_documento`, `assunto_documento`, `id_processo_documento`) VALUES
	(2, 'CI DGI/FAETEC nÂ° 001/2019', 94, 7, '2018-12-27 00:00:00', 'Luiz', 'RelatÃ³rio Institucional das AÃ§Ãµes de TI (2017 ~2018)', 26);
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
  `proc_data_entrada` date DEFAULT NULL,
  `id_orgao` int(11) DEFAULT NULL,
  `observacoes_proc_entrada` longtext,
  PRIMARY KEY (`id_movimento`),
  KEY `id_orgao` (`id_orgao`),
  KEY `id_processo_documento` (`id_processo_documento`),
  KEY `id_tipo_movimento` (`id_tipo_movimento`),
  CONSTRAINT `movimento_ibfk_1` FOREIGN KEY (`id_orgao`) REFERENCES `orgao` (`id_orgao`),
  CONSTRAINT `movimento_ibfk_2` FOREIGN KEY (`id_processo_documento`) REFERENCES `processo_documento` (`id_processo_documento`),
  CONSTRAINT `movimento_ibfk_3` FOREIGN KEY (`id_tipo_movimento`) REFERENCES `tipo_movimento` (`id_tipo_movimento`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela scpd.movimento: ~36 rows (aproximadamente)
/*!40000 ALTER TABLE `movimento` DISABLE KEYS */;
INSERT INTO `movimento` (`id_movimento`, `id_processo_documento`, `id_tipo_movimento`, `proc_data_entrada`, `id_orgao`, `observacoes_proc_entrada`) VALUES
	(1, 8, 1, '2018-12-20', 5, 'recebido nesta data'),
	(2, 9, 1, '2019-01-05', 3, 'observaÃ§Ã£o'),
	(6, 13, 2, '2018-12-24', 2, 'recebido'),
	(8, 15, 1, '2018-12-27', 5, 'processo recebido'),
	(9, 16, 1, '2018-12-27', 1, 'processo recebido'),
	(10, 16, 2, '2018-12-28', 2, 'Enviado'),
	(11, 16, 1, '2018-12-27', 2, 'recebido pelo cvt campinho'),
	(17, 17, 1, '2018-12-28', 4, 'processo recebido neste dia'),
	(18, 17, 2, '2019-01-02', 3, 'processo enviado nesta data'),
	(19, 17, 1, '2019-01-02', 5, 'processo recebido'),
	(20, 17, 1, '2019-01-02', 1, 'processo recebido neste dia'),
	(21, 17, 1, '2019-01-02', 1, 'processo recebido neste dia'),
	(22, 17, 1, '2019-01-02', 1, 'processo recebido'),
	(23, 15, 2, '2019-01-02', 2, 'carga'),
	(24, 15, 2, '2019-01-02', 2, 'carga'),
	(25, 14, 1, '2019-01-03', 5, 'recebido no dia de hoje'),
	(26, 17, 2, '2019-01-03', 3, 'carga'),
	(27, 17, 2, '2019-01-03', 4, 'Processo enviado'),
	(28, 17, 2, '2019-01-03', 5, 'Processo enviado 09:41'),
	(29, 1, 1, '2019-01-03', 4, 'processo recebido'),
	(30, 14, 2, '2019-01-03', 2, 'Processo enviado a Secretaria de EducaÃ§Ã£o'),
	(31, 16, 2, '2019-01-03', 2, 'enviado hoje'),
	(32, 18, 1, '2019-01-04', 1, 'Processo enviado'),
	(33, 18, 2, '2019-01-04', 5, 'carga'),
	(34, 19, 1, '2019-01-03', 2, 'processo recebido'),
	(35, 20, 1, '2018-12-28', 2, 'processo recebido'),
	(36, 21, 1, '0201-09-01', 2, 'processo recebido'),
	(37, 22, 1, '2018-12-30', 2, 'processo recebido'),
	(38, 21, 2, '2019-01-10', 2, 'Processo enviado'),
	(39, 21, 2, '2019-01-09', 18, 'Processo enviado'),
	(40, 21, 2, '2019-01-15', 2, 'Processo enviado'),
	(41, 1, 1, '2019-01-09', 23, 'Processo enviado 10:06'),
	(42, 21, 1, '2019-01-16', 91, 'processo recebido neste dia'),
	(43, 23, 1, '2019-01-16', 12, 'Processo enviado'),
	(45, 26, 1, '2019-01-17', 94, 'Encaminhamos, em anexo, o RelatÃ³rio Institucional das AÃ§Ãµes de TI'),
	(46, 26, 2, '2019-01-17', 11, 'Para conhecimento'),
	(47, 26, 1, '2019-01-18', 16, 'Diretoria administrativa ciente. Tomar as devidas providÃªncias');
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
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela scpd.orgao: ~164 rows (aproximadamente)
/*!40000 ALTER TABLE `orgao` DISABLE KEYS */;
INSERT INTO `orgao` (`id_orgao`, `nome_orgao`, `id_hierarquia_orgao`) VALUES
	(1, 'Apoio Administrativo a Sindicancia', 1),
	(2, '(Sede) - Assessoria da Vice-Presidencia', 1),
	(3, '\r\n(Sede) - Assessoria de Comunicacao - ASSCOM', 1),
	(4, '(Sede) - Assessoria de Controle Interno - ASSECON', 1),
	(5, 'Volta Redonda', 1),
	(6, '(Sede) - Assessoria de Movimentacao e Registros Escolares - AMR/DRE', 1),
	(7, '(Sede) - Assessoria Especial da Presidencia', 1),
	(8, '(Sede) - Assessoria Juridica - ASJUR', 1),
	(9, 'Tres Rios', 1),
	(10, '(Sede) - Centro de Memoria', 1),
	(11, '(Sede) - Diretoria Administrativa', 1),
	(12, '(Sede) - Diretoria de Desenvolvimento da Educacao - DDE', 1),
	(13, 'DESUP', 1),
	(14, '(Sede) - Diretoria de Engenharia Arquitetura e Manutencao - DEAM', 1),
	(15, 'Imbarie', 1),
	(16, '(Sede) - Diretoria de Implantacao e Logistica - DILOG', 1),
	(17, 'Santo Antonio de Padua', 1),
	(18, '(Sede) - Divisao de Alimentacao Escolar - DAE', 1),
	(19, 'Duque de Caxias - Unidade Imbarie', 1),
	(20, '(Sede) - Divisao de Almoxarifado - DALMOX', 1),
	(21, 'Rio', 1),
	(22, '(Sede) - Divisao de Diversidade e Inclusao Educacional', 1),
	(23, '(Sede) - Divisao de Estagio', 1),
	(24, 'Republica', 1),
	(25, '(Sede) - Divisao de Financas - DIFIN', 1),
	(26, '(Sede) - Divisao de Patrimonio - DIVPAT', 1),
	(27, '(Sede) - Divisao de Recursos Humanos - DIVRH', 1),
	(28, '(Sede) - Divisao de Servico Gerais', 1),
	(29, 'Colegio Getulio Vargas', 1),
	(30, 'Petropolis ', 1),
	(31, 'Colegio Joao XXIII', 1),
	(32, 'Henrique Lage', 1),
	(33, 'Republica', 1),
	(34, 'Visconde de Maua', 1),
	(35, 'Paracambi', 1),
	(36, 'Itaperuna', 1),
	(37, 'Favo de Mel', 1),
	(38, 'ISERJ', 1),
	(39, 'Alemao - Unidade Paranhos', 1),
	(40, 'Araruama', 1),
	(41, 'ISEPAM', 1),
	(42, 'Caxias', 1),
	(43, 'Campos', 1),
	(44, 'Bangu', 1),
	(45, 'Barra do Pirai - Unidade Matadouro', 1),
	(46, 'Barra Mansa', 1),
	(47, 'Vila Isabel ', 1),
	(49, 'Via Brasil', 1),
	(50, 'Batan', 1),
	(51, 'Vassouras', 1),
	(52, 'Belford Roxo - Unidade Heliopolis', 1),
	(53, 'Valenca', 1),
	(54, 'Bom Jesus de Itabapoana', 1),
	(55, 'Campinho', 1),
	(57, 'Tijuca', 1),
	(58, 'Teresopolis', 1),
	(59, 'Seropedica', 1),
	(60, 'Saracuruna', 1),
	(61, 'Saquarema - Unidade Helber Vignoli Muniz  Bacaxa', 1),
	(62, 'Central do Brasil', 1),
	(63, 'Sao Pedro da Aldeia', 1),
	(64, 'Marechal Hermes', 1),
	(65, 'Sao Jose do Vale do Rio Preto', 1),
	(66, 'Chapeu Mangueira', 1),
	(67, 'Mesquita', 1),
	(68, 'Sao Jose de Uba', 1),
	(69, 'Cidade de Deus', 1),
	(70, 'Nilopolis - Unidade Paiol de Polvora', 1),
	(71, 'Duque de Caxias - Unidade de Santa Cruz da Serra', 1),
	(72, 'Niteroi - Unidade Armando Valle Leao', 1),
	(73, '(Sede) - Divisao de Transportes - DIVTRAN', 1),
	(74, '(Sede) - Divisao de Vigilancia e Apoio Patrimonial', 1),
	(75, 'Sao Joao de Meriti ', 1),
	(76, '(Sede) - Presidencia', 1),
	(77, 'Silva Jardim', 1),
	(78, 'Sao Joao da Barra', 1),
	(79, 'Sao Goncalo - Unidade Colubande', 1),
	(80, 'Sao Goncalo  - Unidade Gradim', 1),
	(81, 'Sao Fidelis', 1),
	(82, 'Santa Marta', 1),
	(83, 'Santa Cruz', 1),
	(84, 'Rio Claro', 1),
	(85, 'Quitungo', 1),
	(86, 'Quintino - Unidade CEFE', 1),
	(87, 'Quintino', 1),
	(88, 'Queimados ', 1),
	(89, 'Porto Real', 1),
	(90, 'Pirai', 1),
	(91, '(Sede) - Secretaria da Presidencia - SECPRES', 1),
	(94, '(Sede) - Diretoria de Gestao da Informacao - DGI', 1),
	(95, 'Duque de Caxias - Unidade Saracuruna', 1),
	(96, 'Engenho Novo', 1),
	(97, 'Ilha do Governador - Unidade Cocota', 1),
	(98, 'Ilha do Governador - Unidade Galeao', 1),
	(99, 'Ipanema', 1),
	(100, 'Itaborai', 1),
	(102, '(Sede) - Universidade do Servidor - UNIFAETEC', 1),
	(103, '(Sede) - Vice-Presidencia', 1),
	(104, 'Mendes', 1),
	(106, 'Mangueira I', 1),
	(107, 'Mangueira - Unidade Luiz Carlos Ripper', 1),
	(108, 'Amaury Cesar Vieira', 1),
	(109, 'Mage - Unidade Piabeta', 1),
	(110, 'Mage - Unidade Centro', 1),
	(111, 'Ferreira  Viana', 1),
	(112, 'Helber Vignoli Muniz', 1),
	(113, 'Joao Luiz do Nascimento', 1),
	(114, 'Macae', 1),
	(115, 'Levy Gasparian', 1),
	(116, 'Laje do Muriae', 1),
	(117, 'Juscelino Kubitschek', 1),
	(118, 'Maria Mercedes Mendes Teixeira', 1),
	(119, 'Oscar Tenorio', 1),
	(120, 'Santa Cruz', 1),
	(121, 'Paraiba do Sul', 1),
	(122, 'Nova Iguacu - Unidade Paulo Falcao', 1),
	(123, 'Nova Iguacu - Unidade Centro', 1),
	(124, 'Nova Iguacu - Unidade Austin', 1),
	(125, 'Nova Friburgo', 1),
	(126, 'Niteroi - Unidade Armando Valle Leao', 1),
	(127, 'Nilopolis - Unidade Paiol de Polvora', 1),
	(128, 'Henrique Lage', 1),
	(129, 'Teatro Martins Pena', 1),
	(130, 'Transporte Eng. Silva Freire', 1),
	(131, 'Visconde de Maua', 1),
	(132, 'Santo Antonio de Padua', 1),
	(133, 'Japeri', 1),
	(134, 'Jacare', 1),
	(137, 'Quintino - Unidade de Saude Herbert Josa de Souza', 1),
	(138, 'Resende - Unidade Alvorada', 1),
	(139, 'Duque de Caxias - Unidade Xerem', 1),
	(140, 'Guapimirim', 1),
	(141, 'Adolpho Bloch', 1),
	(143, 'Joao Barcelos Martins', 1),
	(145, 'Petropolis', 1),
	(146, 'Pinheiral ', 1),
	(147, 'Niteroi - Unidade Pendotiba', 1),
	(149, 'Engenho Novo', 1),
	(151, 'Agricola Antonio Sarlo', 1),
	(152, 'Arraial do Cabo', 1),
	(153, 'Barra do Pirai - Unidade Parque Sao Joaquim', 1),
	(154, 'Bom Jardim', 1),
	(155, 'Buzios', 1),
	(156, 'Campos - Unidade Ceramica', 1),
	(157, 'Campos - Unidade Lapa', 1),
	(158, 'Campos - Unidade Solda', 1),
	(159, 'Duque de Caxias - Unidade Olavo Bilac', 1),
	(160, 'Duque de Caxias - Unidade Pedro Ramos', 1),
	(161, 'Itaocara', 1),
	(164, 'Miguel Pereira', 1),
	(165, 'Miracema', 1),
	(166, 'SECT - SECRETARIA DE EDUCAÃ‡ÃƒO E TECNOLOGIA', 2);
/*!40000 ALTER TABLE `orgao` ENABLE KEYS */;

-- Copiando estrutura para tabela scpd.processo
CREATE TABLE IF NOT EXISTS `processo` (
  `id_processo` int(11) NOT NULL AUTO_INCREMENT,
  `numero_processo` varchar(250) NOT NULL,
  `id_orgao` int(11) DEFAULT NULL,
  `id_tipo_processo` int(11) DEFAULT NULL,
  `data_inicio` date DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela scpd.processo: ~24 rows (aproximadamente)
/*!40000 ALTER TABLE `processo` DISABLE KEYS */;
INSERT INTO `processo` (`id_processo`, `numero_processo`, `id_orgao`, `id_tipo_processo`, `data_inicio`, `nome_processo`, `assunto_processo`, `id_processo_documento`) VALUES
	(1, 'wcr3456', 4, 2, '2017-10-25', '', 'Processo em andamento no CVT', 1),
	(2, 'aci954567', 3, 2, '2017-08-29', 'maria', 'Processo derivado do TJ', 1),
	(3, 'proc567', 2, 3, '2015-05-12', 'teste', 'assuntoteste', 1),
	(4, 'ACI/5256', 1, 1, '2018-01-24', 'teste2', 'assuntotestedois', 1),
	(5, 'Proc/53178', 2, 2, '2017-10-28', 'JosÃ©', 'Processo Externo', 1),
	(6, 'num9876465', 2, 3, '2011-08-15', 'thales', 'Furto de equipamento do Faeterj', 1),
	(7, 'wcr3456', 4, 1, '2016-06-14', 'joão das couves', 'Processo em andamento no CVT', 4),
	(8, 'Proc/3456', 3, 1, '2013-05-14', 'maria', 'Processo Externo do Tribunal de JustiÃ§a', 6),
	(9, 'ACI/2584', 4, 1, '2017-04-21', 'teste', 'retificacao de ponto', 7),
	(10, 'ACI/2584', 4, 1, '2017-04-21', 'teste', 'retificacao de ponto', 8),
	(11, 'ACI/7564', 3, 1, '2013-10-08', 'maisteste', 'processo disciplinar', 9),
	(12, 'ACI/5254', 2, 1, '2017-10-28', 'testepg', 'assuntotestepg', 10),
	(13, 'ACI/5432', 3, 2, '2011-08-14', 'testepg2', 'assuntotestepg2', 11),
	(14, 'ACI/5353', 4, 2, '2017-08-30', 'testepg3', 'assuntotestepg3', 12),
	(15, 'ACI/7834', 2, 1, '2016-11-28', 'outroteste', 'processo disciplinar', 13),
	(16, 'Proc/9874', 4, 3, '2011-08-10', 'teste47', 'assuntoteste', 14),
	(17, 'Proc/53178', 3, 2, '2018-01-24', 'testepg', 'Processo Externo', 15),
	(18, 'ACI/8476', 2, 1, '2017-10-28', 'teste65', 'Processo SEEDUC', 16),
	(19, 'Proc/87949', 5, 2, '2015-05-12', 'nomequalquer', 'Processo Disciplinar', 17),
	(20, 'ACI/6771', 5, 1, '2017-10-28', 'teste 04/01', 'assuntoteste 04/01', 18),
	(21, 'E-26/005//2134/2018', 2, 2, '2018-06-20', 'clovis', 'fÃ©rias', 19),
	(22, 'Proc/7894654', 2, 1, '2017-10-28', 'testedata', 'assuntodata', 20),
	(23, 'E-26/005//2678/2019', 2, 1, '2018-08-02', 'testedata2', 'assuntodata2', 21),
	(24, '846123', 2, 1, '1970-01-01', 'teste45', 'assunto aleatÃ³rio', 22),
	(25, 'ACI/8546', 16, 1, '2018-07-11', 'testenovo', 'assuntotestenovo', 23);
/*!40000 ALTER TABLE `processo` ENABLE KEYS */;

-- Copiando estrutura para tabela scpd.processo_documento
CREATE TABLE IF NOT EXISTS `processo_documento` (
  `id_processo_documento` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_processo_documento` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_processo_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela scpd.processo_documento: ~23 rows (aproximadamente)
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
	(16, 'ACI/8476'),
	(17, 'Proc/87949'),
	(18, 'ACI/6771'),
	(19, 'E-26/005//2134/2018'),
	(20, 'Proc/7894654'),
	(21, 'E-26/005//2678/2019'),
	(22, '846123'),
	(23, 'ACI/8546'),
	(26, 'CI DGI/FAETEC nÂ° 001/2019');
/*!40000 ALTER TABLE `processo_documento` ENABLE KEYS */;

-- Copiando estrutura para procedure scpd.salvardocumento
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `salvardocumento`(
	IN `pnumero_documento` VARCHAR(255),
	IN `pid_orgao` int,
	IN `pid_tipo_documento` int,
	IN `pdata_inicio` datetime,
	IN `pnome_documento` varchar (255),
	IN `passunto_documento` varchar (255),
	IN `movidata` datetime,
	IN `movid_orgao` int,
	IN `moviobservacoes` longtext

)
BEGIN

	DECLARE vid_processo_documento INT;
	
	INSERT INTO processo_documento values (null, pnumero_documento);
	
	SELECT * FROM processo_documento pd WHERE pd.id_processo_documento = LAST_INSERT_ID();
	
	SET vid_processo_documento = LAST_INSERT_ID();
	
	INSERT INTO documento (numero_documento, id_orgao, id_tipo_documento, data_inicio, nome_documento, assunto_documento, id_processo_documento) 
	VALUES(pnumero_documento, pid_orgao, pid_tipo_documento, pdata_inicio, pnome_documento, passunto_documento, vid_processo_documento);
	
	INSERT INTO MOVIMENTO (id_processo_documento, id_tipo_movimento, proc_data_entrada, id_orgao, observacoes_proc_entrada)
	VALUES (vid_processo_documento, 1, movidata, movid_orgao, moviobservacoes);
	
END//
DELIMITER ;

-- Copiando estrutura para procedure scpd.salvarmovimentodocumento
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `salvarmovimentodocumento`(
	IN `pid_documento` int,
	IN `pid_tipo_movimento` int,
	IN `pproc_data_entrada` datetime,
	IN `pid_orgao` int,
	IN `pobservacoes_proc_entrada` longtext





)
BEGIN

	DECLARE vid_processo_documento int;
	
	SELECT d.id_processo_documento into vid_processo_documento FROM documento d WHERE d.id_documento = pid_documento;
	
	INSERT INTO movimento (id_processo_documento, id_tipo_movimento, proc_data_entrada, id_orgao, observacoes_proc_entrada) 
	values (vid_processo_documento, pid_tipo_movimento, pproc_data_entrada, pid_orgao, pobservacoes_proc_entrada);
	
END//
DELIMITER ;

-- Copiando estrutura para procedure scpd.salvarmovimentoprocesso
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `salvarmovimentoprocesso`(
	IN `pid_processo` int,
	IN `pid_tipo_movimento` int,
	IN `pproc_data_entrada` datetime,
	IN `pid_orgao` int,
	IN `pobservacoes_proc_entrada` longtext





)
BEGIN

	DECLARE vid_processo_documento int;
	
	SELECT p.id_processo_documento into vid_processo_documento FROM processo p WHERE p.id_processo = pid_processo;
	
	INSERT INTO movimento (id_processo_documento, id_tipo_movimento, proc_data_entrada, id_orgao, observacoes_proc_entrada) 
	values (vid_processo_documento, pid_tipo_movimento, pproc_data_entrada, pid_orgao, pobservacoes_proc_entrada);
	
END//
DELIMITER ;

-- Copiando estrutura para procedure scpd.salvarprocesso
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `salvarprocesso`(
	IN `pnumero_processo` VARCHAR(255),
	IN `pid_orgao` int,
	IN `pid_tipo_processo` int,
	IN `pdata_inicio` datetime,
	IN `pnome_processo` varchar (255),
	IN `passunto_processo` varchar (255),
	IN `movidata` datetime,
	IN `movid_orgao` int,
	IN `moviobservacoes` longtext
)
BEGIN

	DECLARE vid_processo_documento INT;
	
	INSERT INTO processo_documento values (null, pnumero_processo);
	
	SELECT * FROM processo_documento pd WHERE pd.id_processo_documento = LAST_INSERT_ID();
	
	SET vid_processo_documento = LAST_INSERT_ID();
	
	INSERT INTO processo (numero_processo, id_orgao, id_tipo_processo, data_inicio, nome_processo, assunto_processo, id_processo_documento) 
	VALUES(pnumero_processo, pid_orgao, pid_tipo_processo, pdata_inicio, pnome_processo, passunto_processo, vid_processo_documento);
	
	INSERT INTO MOVIMENTO (id_processo_documento, id_tipo_movimento, proc_data_entrada, id_orgao, observacoes_proc_entrada)
	VALUES (vid_processo_documento, 1, movidata, movid_orgao, moviobservacoes);
	
END//
DELIMITER ;

-- Copiando estrutura para procedure scpd.salvarusuario
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `salvarusuario`(
	IN `pnome_usuario` VARCHAR(64),
	IN `pcpf` VARCHAR(64),
	IN `pemail` VARCHAR(256),
	IN `psenha` VARCHAR(128),
	IN `pid_orgao` INT,
	IN `pid_nivel_usuario` INT
)
BEGIN

    
	INSERT INTO usuario (nome_usuario , cpf, email, senha, id_orgao, id_nivel_usuario, id_situacao_usuario) 
	VALUES(pnome_usuario, pcpf, pemail, psenha, pid_orgao, pid_nivel_usuario, 2);
    
END//
DELIMITER ;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela scpd.tipo_documento: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `tipo_documento` DISABLE KEYS */;
INSERT INTO `tipo_documento` (`id_tipo_documento`, `tipo_documento`) VALUES
	(1, 'Ata'),
	(2, 'Circular'),
	(3, 'Oficio'),
	(4, 'Alvara'),
	(6, 'Portaria'),
	(7, 'Relatorio');
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela scpd.usuario: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id_usuario`, `nome_usuario`, `cpf`, `email`, `senha`, `tentativa`, `id_orgao`, `id_nivel_usuario`, `id_situacao_usuario`) VALUES
	(1, 'Jose Luiz Garcia', 'luiz', 'luiz@email.com', '$2y$12$i9tm58FU.yRVzPySunKhoOIUyp9SDh8tsaF5JnLcAtSuFWVs03woO', NULL, 1, 1, 1),
	(2, 'Vinicius dos Santos', 'admin', 'vinicius@faetec.com', '$2y$12$YlooCyNvyTji8bPRcrfNfOKnVMmZA9ViM2A3IpFjmrpIbp5ovNmga', NULL, 1, 1, 2),
	(3, 'Thales', 'estag', 'estagiariodgi@faetec.rj.gov.br', '$2y$12$Y6EGRSmQGVB6B0qxVyata.lfC1p6OuF1vnv8y9gzQn4lWsVHlUbny', NULL, 94, 2, 2),
	(4, 'Eduardo', 'coordenador', 'eduardo@faetec', '$2y$12$lFpkQq14V4NnGOTnH4r3bOMbe9VMyiwm0HHm9v4is9HWa1b6KY4/2', NULL, 16, 1, 2),
	(5, 'testeusuario', 'teste', 'usuario@faetec.com', '$2y$12$zkebVETnYEyicX4ewpTNjeJ5wgKfUw2aASmDejD8VSMhIXJDIb6Ky', NULL, 7, 2, 1),
	(6, 'andre', 'andre', 'andre@faetec.com', '$2y$12$S//w1PGjc3gtL.60skpn1eqFnuAL3RAbE/.ATFKqnQI66afBtv0pi', NULL, 94, 1, 2),
	(7, 'Usuario Asscom', 'asscom', 'asscom@faetec.com', '$2y$12$TqWLGq/xIJtidTkaxjEaReszN4GPnbbMh5LcrAQ1pv1Z12Q1McX6m', NULL, 3, 1, 2);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
