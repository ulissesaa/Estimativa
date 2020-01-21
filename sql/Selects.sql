SELECT TD.descricao, NC.descricao, HO.viabilidadeTecnica, HO.desenho, HO.codificacao, HO.teste 
FROM HorasObjeto AS HO 
INNER JOIN TipoDesenvolvimento AS TD 
ON HO.tipoDesenvolvimento = TD.codigo 
INNER JOIN NivelComplexidade AS NC 
ON HO.nivelComplexidade = NC.codigo 

SELECT* FROM TipoDesenvolvimento WHERE codTecnologia =1




