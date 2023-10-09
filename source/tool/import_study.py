import pymysql
pymysql.install_as_MySQLdb()
import MySQLdb
import xlrd

database = MySQLdb.connect(host = "localhost",user = 'wowjw',password = 'zzz111!',db = 'gpeg_rs')
cursor = database.cursor()
table = "tbl_studies"
url = 'C:\\Users\\wowjw\\Downloads\\lu_Studies.xlsx'
book = xlrd.open_workbook(url)
sheet = book.sheet_by_name('Sheet1')

# Create the INSERT INTO SQL query
query = "INSERT INTO {} (study_id,studyname) VALUES (%s,%s)".format(table)

for r in range(1,sheet.nrows):
    study_id = sheet.cell(r,0).value
    study_name = sheet.cell(r,2).value
    values = (study_id,study_name)
    cursor.execute(query,values)

# Close the cursor
cursor.close()

# Commit the transaction
database.commit()

# Close the database connection
database.close()

# Print results
print("Done!")