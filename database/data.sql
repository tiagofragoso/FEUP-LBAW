
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
insert into users ("name",username,email,"password") VALUES ('Ed Sheeran', 'esheeran','edsheeran@edsheeran.com','esheerann');
insert into users ("name",username,email,"password") VALUES ('David Fonseca', 'dfonseca','geral@davidfonseca.com','dfonsecaa');
insert into users ("name",username,email,"password") VALUES ('Eddie Vedder', 'evedder','geral@eddievedder.com','evedderr');

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
insert into members("user_id",birthdate,banned) VALUES (21,'1991-02-17',false);
insert into members("user_id",birthdate,banned) VALUES (22,'1973-06-14',false);
insert into members("user_id",birthdate,banned) VALUES (23,'1964-12-23',false);


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

insert into categories("name") VALUES ('Classical');
insert into categories("name") VALUES ('Country');
insert into categories("name") VALUES ('Latin');
insert into categories("name") VALUES ('Rock');
insert into categories("name") VALUES ('Jazz');
insert into categories("name") VALUES ('R&B');
insert into categories("name") VALUES ('Metal');
insert into categories("name") VALUES ('Blues');
insert into categories("name") VALUES ('Indie');
insert into categories("name") VALUES ('Pop');
/*events*/


insert into events (title,"start_date","end_date","location","address",price,brief,"description","ticket_sale_start_date",banned,"type","private","status",currency,category) VALUES ('Nos Primavera Sound','2019-06-06','2019-06-08','Parque da Cidade Porto','Estrada Interior da Circunvalação, 4100-083 Porto','117','A oitava edição do festival reúne um total de 70 artistas, de 6 a 8 de Junho, no cartaz mais ousado da sua história. ','O Porto vai acolher a oitava edição do NOS Primavera Sound de 6 a 8 de Junho e vai fazê-lo com a mesma filosofia que inspirou o cartaz revolucionário do Primavera Sound Barcelona. As divas do R&B e soul Solange e Erykah Badu e o colombiano J Balvin encabeçam uma programação paritária e ecléctica que reflecte os tempos em que vivemos com a ousadia e diversidade estilística que marcam a actualidade musical.','2019-05-04T15:00-07',false,'Festival',false,'Live',1,6);
insert into events (title,"start_date","end_date","location","address",price,brief,"description","ticket_sale_start_date",banned,"type","private","status",currency,category) VALUES ('Nos Alive 2019','2019-07-11','2019-07-13','Passeio Marítimo de Algés','Passeio Marítimo de Algés, 1495-165 Algés','130','O NOS Alive regressa nos dias 11, 12 e 13 de Julho de 2019. The Cure, Bon Iver, Ornatos Violeta e muitos mais.','NOS Alive é um festival de música anual realizado no Passeio Maritimo de Algés, em Oeiras, Portugal. É organizado pela promotora de eventos Everything Is New e patrocinado pela NOS. Teve a sua primeira edição em 2007 e desde então não sofreu qualquer interrupção','2019-05-07T11:00-07',false,'Festival',false,'Tickets',1,6);
insert into events (title,"start_date","end_date","location","address",price,brief,"description","ticket_sale_start_date",banned,"type","private","status",currency,category) VALUES ('Ed Sheeran','2019-06-01T19:00-07','2019-06-01T22:00-07','Estádio da Luz Lisboa','Av. Eusébio da Silva Ferreira 1500-313 Lisboa','84','A estrela mundial Ed Sheeran acaba de anunciar a digressão de 2019 que tem passagem garantida por Lisboa.','A estrela mundial Ed Sheeran acaba de anunciar a digressão de 2019 que tem passagem garantida por Lisboa, dia 01 de junho, no Estádio da Luz. Portugal faz parte das novas datas em nome próprio, paralelamente com datas de festivais, que se juntam à já anunciada e esgotada digressão de estádios na Árica do Sul, em março de 2019. Durante os meses de maio, junho, julho e agosto de 2019, as novas datas anunciadas passarão por Portugal, França, Espanha, Itália, Alemanha, Áustria, Romênia, Letónia, Rússia, Finlândia, Dinamarca, Hungria e Islândia, terminando no Reino Unido, com dois espetáculos especiais de regresso a casas em Leeds, nos dias 16 e 17 de agosto, e em Ipswich, nos dias 23 e 24 de agosto.','2019-05-07T17:30-07',false,'Concert',false,'Tickets',1,10);
insert into events (title,"start_date","end_date","location","address",price,brief,"description","ticket_sale_start_date",banned,"type","private","status",currency,category) VALUES ('David Fonseca','2019-06-19T18:30-07','2019-06-19T21:30-07','Cine-teatro de Estarreja','Rua Visconde de Valdemouro 3860-389 Estarreja','13','É difícil catalogar David Fonseca, um dos músicos e compositores mais prolíferos e diversificados da história da música portuguesa.','É conhecido pelos seus espetáculos e pela sua performance fora-de-série, nunca se sabe exatamente o que poderá acontecer a seguir. ','2019-05-07T13:00-07',false,'Concert',false,'Live',1,4);
insert into events (title,"start_date","end_date","location","address",price,brief,"description","ticket_sale_start_date",banned,"type","private","status",currency,category) VALUES ('Eddie Vedder','2019-06-20T20:30-07','2019-06-20T23:30-07','Altice Arena Liboa','Rossio dos Olivais, lote 2.13.01A, Parque das Nações, Lisboa 1990-231 Lisboa','45','Eddie Vedder acaba de anunciar uma digressão europeia a solo com passagem confirmada em Lisboa, dia 20 de junho, na Altice Arena. ','A digressão, que terá início a 09 de junho em Amesterdão que terminará em Londres no dia 06 do mês seguinte, terá como convidado especial em todas as capitais europeias Glen Hansard. ','2019-05-07T14:45-07',false,'Concert',false,'Planning',1,4);
/*tickets*/

insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode1',117,8,1);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode2',117,5,1);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode3',117,6,1);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode4',117,7,1);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode5',117,9,1);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode6',117,15,1);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode7',117,16,1);

insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode8',130,8,2);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode9',130,5,2);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode10',130,6,2);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode11',130,7,2);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode12',130,9,2);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode13',130,15,2);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode14',130,16,2);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode15',130,18,2);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode16',130,17,2);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode17',130,11,2);


insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode18',84,8,3);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode19',84,5,3);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode20',84,6,3);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode21',84,7,3);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode22',84,9,3);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode23',84,15,3);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode24',84,16,3);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode25',84,18,3);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode26',84,19,3);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode27',84,20,3);

insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode28',13,8,4);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode29',13,5,4);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode30',13,6,4);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode31',13,7,4);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode32',13,9,4);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode33',13,15,4);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode34',13,16,4);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode35',13,18,4);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode36',13,19,4);
insert into tickets(qrcode, price,"owner",event_id) VALUES ('qrcode37',13,20,4);


/*participations*/

insert into participations("user_id",event_id,"type") VALUES (5,1,'Participant');
insert into participations("user_id",event_id,"type") VALUES (6,1,'Participant');
insert into participations("user_id",event_id,"type") VALUES (8,1,'Participant');
insert into participations("user_id",event_id,"type") VALUES (9,1,'Participant');
insert into participations("user_id",event_id,"type") VALUES (11,1,'Participant');
insert into participations("user_id",event_id,"type") VALUES (20,1,'Artist');
insert into participations("user_id",event_id,"type") VALUES (10,1,'Artist');
insert into participations("user_id",event_id,"type") VALUES (19,1,'Owner');
insert into participations("user_id",event_id,"type") VALUES (17,1,'Host');
insert into participations("user_id",event_id,"type") VALUES (18,1,'Host');

insert into participations("user_id",event_id,"type") VALUES (5,2,'Participant');
insert into participations("user_id",event_id,"type") VALUES (6,2,'Participant');
insert into participations("user_id",event_id,"type") VALUES (8,2,'Participant');
insert into participations("user_id",event_id,"type") VALUES (9,2,'Participant');
insert into participations("user_id",event_id,"type") VALUES (10,2,'Participant');
insert into participations("user_id",event_id,"type") VALUES (11,2,'Participant');
insert into participations("user_id",event_id,"type") VALUES (20,2,'Artist');
insert into participations("user_id",event_id,"type") VALUES (13,2,'Artist');
insert into participations("user_id",event_id,"type") VALUES (19,2,'Owner');
insert into participations("user_id",event_id,"type") VALUES (17,2,'Host');
insert into participations("user_id",event_id,"type") VALUES (18,2,'Host');

insert into participations("user_id",event_id,"type") VALUES (5,3,'Participant');
insert into participations("user_id",event_id,"type") VALUES (6,3,'Participant');
insert into participations("user_id",event_id,"type") VALUES (8,3,'Participant');
insert into participations("user_id",event_id,"type") VALUES (9,3,'Participant');
insert into participations("user_id",event_id,"type") VALUES (10,3,'Participant');
insert into participations("user_id",event_id,"type") VALUES (11,3,'Participant');
insert into participations("user_id",event_id,"type") VALUES (21,3,'Artist');
insert into participations("user_id",event_id,"type") VALUES (14,3,'Owner');
insert into participations("user_id",event_id,"type") VALUES (17,3,'Host');
insert into participations("user_id",event_id,"type") VALUES (18,3,'Host');



insert into participations("user_id",event_id,"type") VALUES (5,4,'Participant');
insert into participations("user_id",event_id,"type") VALUES (6,4,'Participant');
insert into participations("user_id",event_id,"type") VALUES (8,4,'Participant');
insert into participations("user_id",event_id,"type") VALUES (11,4,'Participant');
insert into participations("user_id",event_id,"type") VALUES (22,4,'Artist');
insert into participations("user_id",event_id,"type") VALUES (14,4,'Owner');
insert into participations("user_id",event_id,"type") VALUES (17,4,'Host');


insert into participations("user_id",event_id,"type") VALUES (5,5,'Participant');
insert into participations("user_id",event_id,"type") VALUES (6,5,'Participant');
insert into participations("user_id",event_id,"type") VALUES (8,5,'Participant');
insert into participations("user_id",event_id,"type") VALUES (9,5,'Participant');
insert into participations("user_id",event_id,"type") VALUES (11,5,'Participant');
insert into participations("user_id",event_id,"type") VALUES (15,5,'Participant');
insert into participations("user_id",event_id,"type") VALUES (16,5,'Participant');
insert into participations("user_id",event_id,"type") VALUES (10,5,'Participant');
insert into participations("user_id",event_id,"type") VALUES (19,5,'Participant');
insert into participations("user_id",event_id,"type") VALUES (20,5,'Artist');
insert into participations("user_id",event_id,"type") VALUES (14,5,'Owner');
insert into participations("user_id",event_id,"type") VALUES (17,5,'Host');
insert into participations("user_id",event_id,"type") VALUES (18,5,'Host');

/*invite_requests*/
insert into invite_requests("user_id",invited_user_id, event_id,"type","status") VALUES (17,18,1,'Host','Accepted');
insert into invite_requests("user_id",invited_user_id, event_id,"type","status") VALUES (19,14,1,'Artist','Declined');


/*follows*/
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
insert into follows(follower_id,followed_id) VALUES (6,5);
insert into follows(follower_id,followed_id) VALUES (6,7);
insert into follows(follower_id,followed_id) VALUES (6,10);
insert into follows(follower_id,followed_id) VALUES (6,14);
insert into follows(follower_id,followed_id) VALUES (6,12);
insert into follows(follower_id,followed_id) VALUES (6,11);
insert into follows(follower_id,followed_id) VALUES (13,5);
insert into follows(follower_id,followed_id) VALUES (13,10);
insert into follows(follower_id,followed_id) VALUES (13,14);
insert into follows(follower_id,followed_id) VALUES (13,6);
insert into follows(follower_id,followed_id) VALUES (17,15);
insert into follows(follower_id,followed_id) VALUES (17,5);
insert into follows(follower_id,followed_id) VALUES (17,12);
insert into follows(follower_id,followed_id) VALUES (17,14);
insert into follows(follower_id,followed_id) VALUES (17,16);
insert into follows(follower_id,followed_id) VALUES (7,15);
insert into follows(follower_id,followed_id) VALUES (7,5);
insert into follows(follower_id,followed_id) VALUES (7,9);
insert into follows(follower_id,followed_id) VALUES (7,12);
insert into follows(follower_id,followed_id) VALUES (7,11);
insert into follows(follower_id,followed_id) VALUES (9,13);
insert into follows(follower_id,followed_id) VALUES (9,5);
insert into follows(follower_id,followed_id) VALUES (9,10);
insert into follows(follower_id,followed_id) VALUES (9,18);
insert into follows(follower_id,followed_id) VALUES (9,16);

/*posts */
insert into posts(content,event_id,author_id) VALUES ('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',1,19);
insert into posts(content,event_id,author_id) VALUES ('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',1,19);
insert into posts(content,event_id,author_id) VALUES ('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',2,17);
insert into posts(content,event_id,author_id) VALUES ('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',2,18);
insert into posts(content,event_id,author_id) VALUES ('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',3,17);
insert into posts(content,event_id,author_id) VALUES ('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',3,18);
insert into posts(content,event_id,author_id) VALUES ('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',4,18);
insert into posts(content,event_id,author_id) VALUES ('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',5,7);
insert into posts(content,event_id,author_id) VALUES ('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',5,15);

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

insert into post_likes("user_id",post_id) VALUES (5,3);
insert into post_likes("user_id",post_id) VALUES (17,3);

insert into post_likes("user_id",post_id) VALUES (6,4);
insert into post_likes("user_id",post_id) VALUES (15,4);
insert into post_likes("user_id",post_id) VALUES (13,4);

insert into post_likes("user_id",post_id) VALUES (15,5);
insert into post_likes("user_id",post_id) VALUES (13,5);

insert into post_likes("user_id",post_id) VALUES (11,6);
insert into post_likes("user_id",post_id) VALUES (14,6);
insert into post_likes("user_id",post_id) VALUES (8,6);

insert into post_likes("user_id",post_id) VALUES (11,7);
insert into post_likes("user_id",post_id) VALUES (12,7);
insert into post_likes("user_id",post_id) VALUES (5,7);

insert into post_likes("user_id",post_id) VALUES (11,8);
insert into post_likes("user_id",post_id) VALUES (17,8);

insert into post_likes("user_id",post_id) VALUES (5,9);
insert into post_likes("user_id",post_id) VALUES (7,9);
/*comments*/

insert into comments(content,post_id,"user_id",parent) VALUES ('Contrary to popular belief, Lorem Ipsum is not simply random text.',1,10,NULL);
insert into comments(content,post_id,"user_id",parent) VALUES ('It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.',1,12,1);
insert into comments(content,post_id,"user_id",parent) VALUES ('It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.',5,12,NULL);
insert into comments(content,post_id,"user_id",parent) VALUES ('It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.',8,15,NULL);
insert into comments(content,post_id,"user_id",parent) VALUES ('It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.',8,17,4);
insert into comments(content,post_id,"user_id",parent) VALUES ('It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.',6,6,NULL);
insert into comments(content,post_id,"user_id",parent) VALUES ('It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.',7,8,6);
insert into comments(content,post_id,"user_id",parent) VALUES ('It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.',9,12,7);

/*comment_likes*/

insert into comment_likes("user_id",comment_id) VALUES (5,1);
insert into comment_likes("user_id",comment_id) VALUES (12,1);
insert into comment_likes("user_id",comment_id) VALUES (6,1);
insert into comment_likes("user_id",comment_id) VALUES (13,1);
insert into comment_likes("user_id",comment_id) VALUES (8,1);
insert into comment_likes("user_id",comment_id) VALUES (9,1);

insert into comment_likes("user_id",comment_id) VALUES (5,2);
insert into comment_likes("user_id",comment_id) VALUES (7,2);
insert into comment_likes("user_id",comment_id) VALUES (15,2);
insert into comment_likes("user_id",comment_id) VALUES (16,2);
insert into comment_likes("user_id",comment_id) VALUES (6,2);
insert into comment_likes("user_id",comment_id) VALUES (8,2);
insert into comment_likes("user_id",comment_id) VALUES (13,2);
insert into comment_likes("user_id",comment_id) VALUES (14,2);

/*polls*/

insert into polls(post_id,title) VALUES (1,'Best festival day');
insert into polls(post_id,title) VALUES (3,'Lorem Ipsum');
insert into polls(post_id,title) VALUES (4,'Lorem Ipsum');

/*poll_options*/

insert into poll_options(post_id,"name") VALUES (1,'June 6');
insert into poll_options(post_id,"name") VALUES (1,'June 7');
insert into poll_options(post_id,"name") VALUES (1,'June 8');

insert into poll_options(post_id,"name") VALUES (3,'Option 1');
insert into poll_options(post_id,"name") VALUES (3,'Option 2');
insert into poll_options(post_id,"name") VALUES (3,'Option 3');

insert into poll_options(post_id,"name") VALUES (4,'Option 1');
insert into poll_options(post_id,"name") VALUES (4,'Option 2');
insert into poll_options(post_id,"name") VALUES (4,'Option 3');

/*poll_votes*/

insert into poll_votes(poll_id,"user_id",poll_option) VALUES (1,13,1);
insert into poll_votes(poll_id,"user_id",poll_option) VALUES (1,5,1);
insert into poll_votes(poll_id,"user_id",poll_option) VALUES (1,6,1);
insert into poll_votes(poll_id,"user_id",poll_option) VALUES (1,10,1);

insert into poll_votes(poll_id,"user_id",poll_option) VALUES (1,7,2);
insert into poll_votes(poll_id,"user_id",poll_option) VALUES (1,8,2);

insert into poll_votes(poll_id,"user_id",poll_option) VALUES (1,9,3);
insert into poll_votes(poll_id,"user_id",poll_option) VALUES (1,11,3);
insert into poll_votes(poll_id,"user_id",poll_option) VALUES (1,12,3);


/*files*/

insert into files(post_id,"file") VALUES (2,'file1');
insert into files(post_id,"file") VALUES (5,'file2');
insert into files(post_id,"file") VALUES (6,'file3');
insert into files(post_id,"file") VALUES (7,'file4');

/*threads*/


insert into threads(content,event_id,author_id) VALUES ('What is Lorem Ipsum?',1,17);
insert into threads(content,event_id,author_id) VALUES ('What is Lorem Ipsum?',1,18);
insert into threads(content,event_id,author_id) VALUES ('What is Lorem Ipsum?',2,17);
insert into threads(content,event_id,author_id) VALUES ('What is Lorem Ipsum?',5,17);

/*threads comments*/
insert into thread_comments(content,thread_id,"user_id") VALUES ('Lorem Ipsum is simply dummy text of the printing and typesetting industry.',1,18);
insert into thread_comments(content,thread_id,"user_id") VALUES ('Lorem Ipsum is simply dummy text of the printing and typesetting industry.',2,17);
insert into thread_comments(content,thread_id,"user_id") VALUES ('Lorem Ipsum is simply dummy text of the printing and typesetting industry.',3,18);


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
insert into user_reports("user_id",reported_user,"status") VALUES (7,8,'Accepted');
insert into user_reports("user_id",reported_user,"status") VALUES (5,10,'Declined');
insert into user_reports("user_id",reported_user,"status") VALUES (12,7,'Pending');
insert into user_reports("user_id",reported_user,"status") VALUES (6,5,'Pending');


/*event reports*/
insert into event_reports(event_id,"user_id","status") VALUES (1,6,'Declined');
insert into event_reports(event_id,"user_id","status") VALUES (1,7,'Declined');
insert into event_reports(event_id,"user_id","status") VALUES (1,5,'Declined');
insert into event_reports(event_id,"user_id","status") VALUES (1,10,'Pending');
