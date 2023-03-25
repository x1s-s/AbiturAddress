DROP TABLE ResultTable
GO
CREATE TABLE ResultTable
(
    Код                      INT IDENTITY (1,1) PRIMARY KEY,
    [Почтновый адрес]        VARCHAR(20),
    [Страна]                 VARCHAR(15),
    [Область]                VARCHAR(15),
    [Город]                  VARCHAR(15),
    [Тип населённого пункта] VARCHAR(5),
    [Населённый пункт]       VARCHAR(15),
    [Тип улицы]              VARCHAR(10),
    [Улица]                  VARCHAR(25),
    [Дом]                    VARCHAR(5),
    [КорпусСтроение]         VARCHAR(10),
    [Квартира]               VARCHAR(4),
    [ФИО]                    VARCHAR(100)
)