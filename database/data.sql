
insert into users ("name",username,email,"password") VALUES ('Bryan Tremblay','btremblay','bTremblay@gmail.com','btremblayy');
insert into users ("name",username,email,"password") VALUES ('Salvador Tyler','styler','styler@gmail.com','stylerr');
insert into users ("name",username,email,"password") VALUES ('Salma Strong','sstrong','sstrong@gmail.com','sstrongg');
insert into users ("name",username,email,"password") VALUES ('Soren Chase','schase','schase@gmail.com','schasee');
insert into users ("name",username,email,"password") VALUES ('Lola Cline','lcline','lcline@gmail.com','lclinee');
insert into users ("name",username,email,"password") VALUES ('Leia Oconnor','loconnor','loconnor@gmail.com','loconnorr');
insert into users ("name",username,email,"password") VALUES ('Evan Tran','etran','etran@gmail.com','etrann');
insert into users ("name",username,email,"password") VALUES ('Mina Calhoun','mcalhoun','mcalhoun@gmail.com','mcalhounn');
insert into users ("name",username,email,"password") VALUES ('Nikolas Lawrence','nlawrence','nlawrence@gmail.com','nlawrencee');
insert into users ("name",username,email,"password") VALUES ('Lawrence Powell','lpowell','lpowell@gmail.com','lpowelll');
insert into users ("name",username,email,"password") VALUES ('Andrea Wheeler','awheeler','awheeler@gmail.com','awheelerr');
insert into users ("name",username,email,"password") VALUES ('Shannon Reynolds','sreynolds','sreynolds@gmail.com','sreynoldss');
insert into users ("name",username,email,"password") VALUES ('Benjamin Kelley','bkelley','bkelley@gmail.com','bkelley');
insert into users ("name",username,email,"password") VALUES ('Camilla Lowe','clowe','clowe@gmail.com','clowee');
insert into users ("name",username,email,"password") VALUES ('Shyann Jennings','sjennings','sjennings@gmail.com','sjennings');
insert into users ("name",username,email,"password") VALUES ('Nancy Krueger','nkrueger','nkrueger@gmail.com','nkrueger');
insert into users ("name",username,email,"password") VALUES ('Tara Guerra','tguerra','tguerra@gmail.com','tguerraa');
insert into users ("name",username,email,"password") VALUES ('Victor Harrington','vharrington','vharrington@gmail.com','vharringtonn');
insert into users ("name",username,email,"password") VALUES ('Jadyn Peters','jpeters','jpeters@gmail.com','jpeters');
insert into users ("name",username,email,"password") VALUES ('Milo Parrish','mparrish','mparrish@gmail.com','mparrishh');
insert into users ("name",username,email,"password") VALUES ('Philip Friduman','pfriduman','pfriduman@gmail.com','pfridumann');

/*members*/

insert into members("user_id",birthdate,banned) VALUES (5,'1968-05-31',false);
insert into members("user_id",birthdate,banned) VALUES (6,'1968-09-06',false);
insert into members("user_id",birthdate,banned) VALUES (7,'1971-05-19',false);
insert into members("user_id",birthdate,banned) VALUES (8,'1971-08-04',false);
insert into members("user_id",birthdate,banned) VALUES (9,'1975-05-29',false);
insert into members("user_id",birthdate,banned) VALUES (10,'1978-06-06',false);
insert into members("user_id",birthdate,banned) VALUES (11,'1985-02-25',false);
insert into members("user_id",birthdate,banned) VALUES (12,'1986-04-30',false);
insert into members("user_id",birthdate,banned) VALUES (13,'1988-06-01',false);
insert into members("user_id",birthdate,banned) VALUES (14,'1989-04-18',false);
insert into members("user_id",birthdate,banned) VALUES (15,'1990-12-12',false);
insert into members("user_id",birthdate,banned) VALUES (16,'1991-06-25',false);
insert into members("user_id",birthdate,banned) VALUES (17,'1995-03-14',false);
insert into members("user_id",birthdate,banned) VALUES (18,'1995-03-14',false);
insert into members("user_id",birthdate,banned) VALUES (19,'1998-03-05',false);
insert into members("user_id",birthdate,banned) VALUES (20,'2001-11-20',false);


/*admins*/

insert into admins("user_id") VALUES (1);
insert into admins("user_id") VALUES (2);
insert into admins("user_id") VALUES (3);
insert into admins("user_id") VALUES (4);

/*currencies*/
insert into currencies (code,"name") VALUES('EUR','Euro');
insert into currencies (code,"name") VALUES('USD','US dollar');
insert into currencies (code,"name") VALUES('GBP','Pound sterling');
insert into currencies (code,"name") VALUES('CNH','Chinese renminbi');

/*categories*/


insert into categories("name") VALUES ('classical');
insert into categories("name") VALUES ('country');
insert into categories("name") VALUES ('latin');
insert into categories("name") VALUES ('rock');
insert into categories("name") VALUES ('jazz');
insert into categories("name") VALUES ('r&b');
insert into categories("name") VALUES ('metal');
insert into categories("name") VALUES ('blues');
insert into categories("name") VALUES ('indie');

/*events*/

insert into events (title,"start_date","end_date","location","address",price,brief,"description","ticket_sale_start_date",banned,"type","private","status",currency,category) VALUES ('Nos Primavera Sound','2019-06-06','2019-06-08','Parque da Cidade Porto','Estrada Interior da Circunvalação, 4100-083 Porto','117','A oitava edição do festival reúne um total de 70 artistas, de 6 a 8 de Junho, no cartaz mais ousado da sua história. ','O Porto vai acolher a oitava edição do NOS Primavera Sound de 6 a 8 de Junho e vai fazê-lo com a mesma filosofia que inspirou o cartaz revolucionário do Primavera Sound Barcelona. As divas do R&B e soul Solange e Erykah Badu e o colombiano J Balvin encabeçam uma programação paritária e ecléctica que reflecte os tempos em que vivemos com a ousadia e diversidade estilística que marcam a actualidade musical.','2019-04-04',false,'Festival',false,'Live',1,6);


/*tickets*/

insert into tickets(qrcode, purchase_date,price,"owner",event_id) VALUES ('qrcode1','2019-04-04',117,8,1);
insert into tickets(qrcode, purchase_date,price,"owner",event_id) VALUES ('qrcode2','2019-04-04',117,5,1);
insert into tickets(qrcode, purchase_date,price,"owner",event_id) VALUES ('qrcode1','2019-04-04',117,6,1);
insert into tickets(qrcode, purchase_date,price,"owner",event_id) VALUES ('qrcode1','2019-04-04',117,7,1);
insert into tickets(qrcode, purchase_date,price,"owner",event_id) VALUES ('qrcode1','2019-04-04',117,9,1);
insert into tickets(qrcode, purchase_date,price,"owner",event_id) VALUES ('qrcode1','2019-04-04',117,15,1);
insert into tickets(qrcode, purchase_date,price,"owner",event_id) VALUES ('qrcode1','2019-04-04',117,16,1);


/*participations*/

insert into participations("user_id",event_id,"type","date") VALUES (5,1,'Participant','2019-03-07');
insert into participations("user_id",event_id,"type","date") VALUES (6,1,'Participant','2019-03-02');
insert into participations("user_id",event_id,"type","date") VALUES (8,1,'Participant','2019-03-02');
insert into participations("user_id",event_id,"type","date") VALUES (9,1,'Participant','2019-03-07');
insert into participations("user_id",event_id,"type","date") VALUES (10,1,'Participant','2019-03-07');
insert into participations("user_id",event_id,"type","date") VALUES (11,1,'Participant','2019-03-07');
insert into participations("user_id",event_id,"type","date") VALUES (20,1,'Artist','2019-03-06');
insert into participations("user_id",event_id,"type","date") VALUES (10,1,'Artist','2019-03-07');
insert into participations("user_id",event_id,"type","date") VALUES (19,1,'Owner','2019-02-25');
insert into participations("user_id",event_id,"type","date") VALUES (17,1,'Host','2019-03-07');
insert into participations("user_id",event_id,"type","date") VALUES (18,1,'Host','2019-03-10');

insert into invite_requests("user_id",invited_user_id, event_id,"type","status","date") VALUES (6,5,1,'Participant','Accepted','2019-03-02');
insert into invite_requests("user_id",invited_user_id, event_id,"type","status","date") VALUES (17,18,1,'Host','Accepted','2019-03-08');
insert into invite_requests("user_id",invited_user_id, event_id,"type","status","date") VALUES (9,16,1,'Participant','Pending','2019-03-09');
insert into invite_requests("user_id",invited_user_id, event_id,"type","status","date") VALUES (19,14,1,'Artist','Declined','2019-03-02');



insert into follows(follower_id,followed_id) VALUES (15,5);
insert into follows(follower_id,followed_id) VALUES (15,6);
insert into follows(follower_id,followed_id) VALUES (15,7);
insert into follows(follower_id,followed_id) VALUES (15,8);
insert into follows(follower_id,followed_id) VALUES (15,9);
insert into follows(follower_id,followed_id) VALUES (15,10);
insert into follows(follower_id,followed_id) VALUES (15,11);
insert into follows(follower_id,followed_id) VALUES (15,12);
insert into follows(follower_id,followed_id) VALUES (5,14);
insert into follows(follower_id,followed_id) VALUES (5,6);
insert into follows(follower_id,followed_id) VALUES (5,7);
insert into follows(follower_id,followed_id) VALUES (5,9);
insert into follows(follower_id,followed_id) VALUES (5,15);
insert into follows(follower_id,followed_id) VALUES (10,11);
insert into follows(follower_id,followed_id) VALUES (11,5);
insert into follows(follower_id,followed_id) VALUES (11,10);
insert into follows(follower_id,followed_id) VALUES (11,14);
insert into follows(follower_id,followed_id) VALUES (11,6);

insert into posts(content,"date",likes,event_id,author_id) VALUES ('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','2019-04-01',6,1,19);
insert into posts(content,"date",likes,event_id,author_id) VALUES ('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.','2019-02-02',8,1,19);


/*post_likes*/

insert into post_likes("user_id",post_id) VALUES (10,1);
insert into post_likes("user_id",post_id) VALUES (5,1);
insert into post_likes("user_id",post_id) VALUES (6,1);
insert into post_likes("user_id",post_id) VALUES (7,1);
insert into post_likes("user_id",post_id) VALUES (8,1);
insert into post_likes("user_id",post_id) VALUES (9,1);

insert into post_likes("user_id",post_id) VALUES (18,2);
insert into post_likes("user_id",post_id) VALUES (5,2);
insert into post_likes("user_id",post_id) VALUES (10,2);
insert into post_likes("user_id",post_id) VALUES (11,2);
insert into post_likes("user_id",post_id) VALUES (13,2);
insert into post_likes("user_id",post_id) VALUES (14,2);
insert into post_likes("user_id",post_id) VALUES (16,2);
insert into post_likes("user_id",post_id) VALUES (17,2);



/*comments*/

insert into comments(content,"date",likes,post_id,"user_id",parent) VALUES ('Contrary to popular belief, Lorem Ipsum is not simply random text.','2019-04-03',2,1,10,NULL);
insert into comments(content,"date",likes,post_id,"user_id",parent) VALUES ('It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.','2019-04-03',4,1,12,1);

/*comment_likes*/


insert into comment_likes("user_id",comment_id) VALUES (5,1);
insert into comment_likes("user_id",comment_id) VALUES (12,1);

insert into comment_likes("user_id",comment_id) VALUES (5,2);
insert into comment_likes("user_id",comment_id) VALUES (7,2);
insert into comment_likes("user_id",comment_id) VALUES (15,2);
insert into comment_likes("user_id",comment_id) VALUES (16,2);
/*polls*/

insert into polls(post_id,title) VALUES (1,'Best festival day');

/*poll_options*/

insert into poll_options(post_id,"name",votes) VALUES (1,'June 6',4);
insert into poll_options(post_id,"name",votes) VALUES (1,'June 7',2);
insert into poll_options(post_id,"name",votes) VALUES (1,'June 8',3);

/*poll_votes*/

insert into poll_votes(poll_option_id,"user_id") VALUES (1,13);
insert into poll_votes(poll_option_id,"user_id") VALUES (1,5);
insert into poll_votes(poll_option_id,"user_id") VALUES (1,6);
insert into poll_votes(poll_option_id,"user_id") VALUES (1,10);

insert into poll_votes(poll_option_id,"user_id") VALUES (2,7);
insert into poll_votes(poll_option_id,"user_id") VALUES (2,8);

insert into poll_votes(poll_option_id,"user_id") VALUES (3,9);
insert into poll_votes(poll_option_id,"user_id") VALUES (3,11);
insert into poll_votes(poll_option_id,"user_id") VALUES (3,12);


/*files*/

insert into files(post_id,"file") VALUES (2,'file1');


/* questions*/
insert into questions(content,event_id) VALUES ('What is Lorem Ipsum?',1);
insert into questions(content,event_id) VALUES ('Where does it come from?',1);
insert into questions(content,event_id) VALUES ('Why do we use it?',1);
insert into questions(content,event_id) VALUES ('Where can I get some?',1);


/*answers*/

insert into answers(question_id,content) VALUES (1,'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.');
insert into answers(question_id,content) VALUES (2,'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.');
insert into answers(question_id,content) VALUES (3,'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout');
insert into answers(question_id,content) VALUES (4,'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable.');

/*user reports*/
insert into user_reports("user_id",reported_user,"status","date") VALUES (7,8,'Accepted','2019-03-31');
insert into user_reports("user_id",reported_user,"status","date") VALUES (5,10,'Declined','2019-04-01');
insert into user_reports("user_id",reported_user,"status","date") VALUES (12,7,'Pending','2019-04-02');
insert into user_reports("user_id",reported_user,"status","date") VALUES (6,5,'Pending','2019-04-02');


/*event reports*/
insert into event_reports(event_id,"user_id","status","date") VALUES (1,6,'Declined','2019-03-31');
insert into event_reports(event_id,"user_id","status","date") VALUES (1,7,'Declined','2019-03-31');
insert into event_reports(event_id,"user_id","status","date") VALUES (1,5,'Declined','2019-03-31');
insert into event_reports(event_id,"user_id","status","date") VALUES (1,10,'Pending','2019-04-02');
