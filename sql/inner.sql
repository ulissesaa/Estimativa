SELECT * FROM Chamado WHERE numeroChamado = 555 AND dataCriacao >= '2018-11-01' AND dataCriacao <= '2018-11-14'

SELECT * FROM Chamado
SELECT * FROM Desenvolvimentos

SELECT 
Tecnologias.descricao as Tecnologia,
OrigemObjeto.descricao as Origem, 
TipoDesenvolvimento.descricao as Objeto, 
NivelComplexidade.descricao as Complexidade,
analiseViabilidade,
especificacaoTecnica,
codificacao,
testes 

FROM Desenvolvimentos 
INNER JOIN OrigemObjeto ON Desenvolvimentos.origemObjeto = OrigemObjeto.codigo 
INNER JOIN TipoDesenvolvimento ON Desenvolvimentos.tipoDesenvolvimento = TipoDesenvolvimento.codigo
INNER JOIN Tecnologias ON TipoDesenvolvimento.codTecnologia = Tecnologias.codigo
INNER JOIN NivelComplexidade  ON Desenvolvimentos.nivelComplexidade = NivelComplexidade.codigo

WHERE Desenvolvimentos.codigoChamado = 221; 
 
 DELETE FROM Chamado
 DELETE FROM Desenvolvimentos
 DELETE FROM HorasObjeto
 DELETE FROM NivelComplexidade
 DELETE FROM OrigemObjeto
 DELETE FROM Tecnologias
 DELETE FROM TipoDesenvolvimento

 SELECT * FROM Chamado
 SELECT * FROM Desenvolvimentos
 SELECT * FROM HorasObjeto
 SELECT * FROM NivelComplexidade
 SELECT * FROM OrigemObjeto
 SELECT * FROM Tecnologias
 SELECT * FROM TipoDesenvolvimento