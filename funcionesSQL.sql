
-- Disparador del cambio de estado para la competencia, la cual al detectar que un juez es asignado a la competencia este dispara una funcion

DELIMITER $$
CREATE TRIGGER cambioEstadoCompetencia AFTER UPDATE ON competencia_juez
FOR EACH ROW
BEGIN
    DECLARE dummy INT;
    SET dummy = cambioEstado();
END $$

DELIMITER ;

--------------------------------------------------------------------------------------------------------------------------------------------------------------
-- Funcion que llama al procedimieto ya almacenado, esto es mas que nada para poder ejecutar dicho procedimiento ante un Disparador 

DELIMITER $$
CREATE FUNCTION cambioEstado() RETURNS INT DETERMINISTIC
BEGIN
    -- Llama al procedimiento almacenado aquí
    CALL actualizarEstadosCompetencias();
    RETURN 1;
END$$
DELIMITER ;

--------------------------------------------------------------------------------------------------------------------------------------------------------------
-- Procedimieto almacenado en la BD, la cual actualiza los estados de las competencias que tengan 3 jueces asignados

DELIMITER $$
CREATE PROCEDURE actualizarEstadosCompetencias()
BEGIN
    UPDATE competencias AS c
	SET estado = 2
	WHERE (
    SELECT COUNT(*) = 3
    FROM competencia_juez AS cj
    WHERE cj.id_competencia = c.id
    AND cj.aprobado = 1
);
END $$
DELIMITER ;
--------------------------------------------------------------------------------------------------------------------------------------------------------------
-- Es un Disparador el cual se ejecuta por cada tupla que se inserta en competencia_juez, realizando que se actualice la columna de cant_jueces en cada tupla de competencias.

CREATE TRIGGER countJuez AFTER UPDATE ON competencia_juez
FOR EACH ROW
UPDATE competencias
SET cant_jueces = (
    SELECT COUNT(*)
    FROM competencia_juez cj
    WHERE new.id_competencia = cj.id_competencia and cj.aprobado='1'
)
WHERE competencias.id = new.id_competencia;