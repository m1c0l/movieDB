UID = dist
FILES = readme.txt team.txt create.sql load.sql queries.sql www/query.php violate.sql

dist: $(FILES)
	mkdir -p $(UID)
	cp $(FILES) $(UID)
	zip -r $(UID).zip $(UID)
	rm -rf $(UID)

clean:
	rm -rf $(UID) $(UID).zip
