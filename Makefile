UID = $(shell sed 's/,.*//' team.txt)
ZIP = P1A.zip
FILES = readme.txt team.txt create.sql load.sql queries.sql www/query.php violate.sql

reload:
	mysql CS143 < clean.sql
	mysql CS143 < create.sql
	mysql CS143 < load.sql

dist: $(FILES)
	mkdir -p $(UID)
	cp $(FILES) $(UID)
	zip -r $(ZIP) $(UID)
	rm -rf $(UID)

clean:
	rm -rf $(UID) $(ZIP)
