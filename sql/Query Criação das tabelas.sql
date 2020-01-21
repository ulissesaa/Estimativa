USE BDGestaoDev

CREATE TABLE Tecnologias(
codigo INT PRIMARY KEY IDENTITY,
descricao VARCHAR(50) NOT NULL
)

CREATE TABLE OrigemObjeto(
codigo INT PRIMARY KEY IDENTITY,
descricao VARCHAR(50) NOT NULL
)
INSERT INTO OrigemObjeto VALUES 
('NOVO'),('MODIFICAÇÃO')

CREATE TABLE TipoDesenvolvimento(
codigo INT PRIMARY KEY IDENTITY,
descricao VARCHAR(50) NOT NULL,
codTecnologia INT REFERENCES Tecnologias(codigo) NOT NULL
)

CREATE TABLE NivelComplexidade(
codigo INT PRIMARY KEY IDENTITY,
descricao VARCHAR(15) NOT NULL
)
INSERT INTO NivelComplexidade VALUES ('MUITO BAIXA'),('BAIXA'),('MEDIA'),('ALTA'),('MUITO ALTA')

Drop Table horasObjeto
CREATE TABLE HorasObjeto(
origemObjeto INT REFERENCES OrigemObjeto(codigo) NOT NULL,
tipoDesenvolvimento INT REFERENCES TipoDesenvolvimento(codigo) NOT NULL,
nivelComplexidade INT REFERENCES NivelComplexidade(codigo) NOT NULL,
analiseViabilidade INT NOT NULL,
especificacaoTecnica INT NOT NULL,
codificacao INT NOT NULL,
teste INT NOT NULL,
CONSTRAINT codigo PRIMARY KEY (origemObjeto, tipoDesenvolvimento, nivelComplexidade)
)

CREATE TABLE Chamado(
codigo INT PRIMARY KEY IDENTITY,
numeroChamado INT NOT NULL,
projeto VARCHAR (500) NOT NULL,
descricao VARCHAR (1000) NOT NULL,
dataCriacao DATE NOT NULL,
responsavel VARCHAR (100) NOT NULL
)

DROP TABLE Desenvolvimentos
CREATE TABLE Desenvolvimentos(
codigo INT PRIMARY KEY IDENTITY,
codigoChamado INT REFERENCES Chamado(codigo) NOT NULL,
origemObjeto INT REFERENCES OrigemObjeto(codigo) NOT NULL,
tipoDesenvolvimento INT REFERENCES TipoDesenvolvimento(codigo) NOT NULL,
nivelComplexidade INT REFERENCES NivelComplexidade(codigo) NOT NULL,
descricao VARCHAR (2000) NOT NULL,
criteriosComplexidade VARCHAR (2000) NOT NULL,
analiseViabilidade INT NOT NULL,
especificacaoTecnica INT NOT NULL,
codificacao INT NOT NULL,
teste INT NOT NULL
)


USE BDGestaoDev
GO
DROP TABLE Tecnologias
GO
DROP TABLE NivelComplexidade
GO
DROP TABLE TipoDesenvolvimento
GO
DROP TABLE DetalhesObjeto;
GO
DROP TABLE HorasObjeto;
GO

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
        teste
        
        FROM Desenvolvimentos 
        INNER JOIN OrigemObjeto ON Desenvolvimentos.origemObjeto = OrigemObjeto.codigo 
        INNER JOIN TipoDesenvolvimento ON Desenvolvimentos.tipoDesenvolvimento = TipoDesenvolvimento.codigo
        INNER JOIN Tecnologias ON TipoDesenvolvimento.codTecnologia = Tecnologias.codigo
        INNER JOIN NivelComplexidade  ON Desenvolvimentos.nivelComplexidade = NivelComplexidade.codigo
        
        WHERE Desenvolvimentos.codigoChamado = 21



Insert into desenvolvimentos values (6,1,1,1,'qwe','qwe',1,1,1,1)



DELETE FROM Desenvolvimentos
DELETE FROM Chamado

INSERT INTO Desenvolvimentos 
    (codigoChamado, origemObjeto, tipoDesenvolvimento, nivelComplexidade, 
    descricao, criteriosComplexidade, analiseViabilidade, especificacaoTecnica, codificacao, teste) 
    VALUES (6,2, 2, 2, 'DFGH', 'sdfg',3, 4, 5, 1)
