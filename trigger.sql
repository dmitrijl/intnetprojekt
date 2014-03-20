DELIMITER |

CREATE TRIGGER increase_numThreads AFTER INSERT ON threads
	FOR EACH ROW BEGIN
		UPDATE categories SET numThreads = numThreads+1 WHERE id = NEW.category;
	END
|

DELIMITER ;
