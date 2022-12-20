DROP TABLE ResultTable
GO
CREATE TABLE ResultTable(
  Код INT IDENTITY(1,1) PRIMARY KEY,
  ФИО VARCHAR(50) NOT NULL,
  [Номер паспорта] VARCHAR(15) NOT NULL UNIQUE,
  Область VARCHAR(28) NOT NULL,
  Город VARCHAR(31) NOT NULL,
  [Населённый пункт] VARCHAR(24) NOT NULL,
  Улица VARCHAR(32) NOT NULL,
  [Номер строения] VARCHAR(5) NOT NULL,
  [Почтовый индекс] VARCHAR(15) NOT NULL
)