UID = $(shell sed 's/,.*//' team.txt)
ZIP = P1B.zip
FILES = readme.txt team.txt sql/ www/ testcase/

reload:
	mysql CS143 < clean.sql
	mysql CS143 < create.sql
	mysql CS143 < load.sql

dist: $(FILES)
	mkdir -p $(UID)
	cp -r $(FILES) $(UID)
	zip -r $(ZIP) $(UID)
	rm -rf $(UID)

clean:
	rm -rf $(UID) $(ZIP)
