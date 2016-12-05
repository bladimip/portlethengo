/*Population script for coursework
due to some issues previously, im adding line that sets auto increment to 1
*/
SET @@auto_increment_increment=1;

/*users
*/
INSERT INTO Users (clubAdmin, nkpag, siteAdmin, username, email, password)
VALUES (0, 0, 1, "site", "admin123@rgu.ac.uk", "site1"),
(0, 1, 0, "map", "map123@rgu.ac.uk", "map1"),
(1, 0, 0, "golf", "golf123@rgu.ac.uk", "golf1"),
(1, 0, 0, "soccer", "soccer123@rgu.ac.uk", "soccer1"),
(1, 1, 0, "combined", "combined123@rgu.ac.uk", "combined1"),
(0, 0, 0, "simple", "user123@rgu.ac.uk", "simple1"),
(0, 0, 0, "simple2", "user2000@rgu.ac.uk", "simple22"),
(0, 0, 0, "simple3", "user3000@rgu.ac.uk", "simple33"),
(1, 0, 0, "golf2", "golf2000@rgu.ac.uk", "golf22");

/*clubgenre
should be populated before Clubs table
*/
INSERT INTO ClubGenre (code, category)
VALUES ("gf", "Golf"),
("fb", "Football"),
("bb", "Basketball"),
("ry", "Rugby"),
("ma", "Martial Arts"),
("ih", "Ice Hockey"),
("wl", "Weight Lifting");

/*clubs
*/
INSERT INTO Clubs (name, genreCode, description, phone, email, address)
VALUES ("Best (Golf) Club Ever!", "gf", "Suspendisse tempus nibh sit amet fermentum condimentum. Vestibulum in lorem pharetra, tincidunt metus id, tincidunt arcu. Nunc et iaculis nunc, in scelerisque tellus. Morbi facilisis libero nec turpis sodales vestibulum. In non tellus eget felis fermentum consequat. Fusce dapibus placerat est nec malesuada. Aenean lobortis eleifend nulla, et aliquet enim accumsan et.

In vel magna eros. Mauris maximus elementum sapien, a scelerisque lectus euismod quis. Vestibulum volutpat pulvinar diam quis molestie. Phasellus malesuada ut ipsum sit amet hendrerit. Etiam ut elit sed nibh sodales interdum. Donec non elit rhoncus, malesuada dolor ac, iaculis tortor. Aenean lorem neque, ultricies vel lacinia.", "01224 123456", "bestever@rgu.ac.uk", "1 Golf Street, Aberdeen, AB11 1GF"),
("Fight Club", "ma", "Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent tincidunt mattis leo eu sollicitudin. Aliquam commodo velit lectus, id molestie elit interdum quis. Mauris iaculis enim vel sapien feugiat condimentum. Fusce eget vehicula odio, a efficitur nibh. Etiam in massa nisi. Nulla facilisi. Aenean ac euismod neque. Vivamus vitae augue vitae turpis varius eleifend quis ac lorem. Nullam arcu neque, pretium at justo at, aliquam.", "+44 777 1234", "soap@rgu.ac.uk, insurance@rgu.ac.uk", "13 Friday Street, Aberdeen, AB13 7FK"),
("Sunday Golfers", "gf", "
Fusce venenatis iaculis dolor tristique accumsan. Integer molestie magna sapien, nec finibus dolor iaculis quis. Donec sit amet dui commodo, fringilla ipsum eu, condimentum augue. Phasellus lacinia orci orci, in.", "0777 6666", "sunday@rgu.ac.uk", "9 Seaside Avenue, Ground Floor Left, Torry, Aberdeen, AB33 3FS"),
("West Ham Aberdeen", "fb", "Quisque pulvinar ipsum quis libero ornare, eget dictum elit auctor. Nam sodales ut sem sed congue. Praesent pellentesque odio in volutpat accumsan. Suspendisse varius dictum ex et euismod. Donec sit.", "01224 565656", "whaberdeen@rgu.ac.uk", "Aberdeen Main Stadium Basement, Aberdeen, Scotland, AB22 2WH");

/*clubadmins
*/
INSERT INTO ClubAdmins (user_id, club_id)
VALUES (3, 1),
(3, 3),
(4, 4),
(5, 2),
(9, 1);

/*clubevents
*/
INSERT INTO ClubEvents (club_id, user_id, approvedBy, name, description, eventDate, status)
VALUES (1, 3, 3, "100th ANNIVERSARY GAME", "Aenean volutpat tristique dapibus. Donec tempor nulla leo, nec aliquam purus feugiat id. Duis id varius orci, a.", "2016-12-01 12:00:00", "approved"),
(1, 3, 3, "AfterParty Games", "Nullam tempor blandit augue quis viverra. Nam sit amet orci vitae.", "2016-12-02 00:00:00", "approved"),
(1, 6, 3, "PreParty Games", "Nam rhoncus rhoncus massa quis commodo. Nullam hendrerit malesuada tortor, quis.", "2016-11-30 18:30:00", "approved"),
(2, 6, 5, "Unusual activity day", "Vivamus egestas vel ligula eget mollis. Donec sit amet quam turpis. Vestibulum eu nulla rhoncus, consectetur lorem sed, laoreet purus. Nulla luctus egestas elit nec ullamcorper. Pellentesque eu eros.", "2016-12-01 00:00:00", "approved"),
(4, 7, NULL, "Friendly game - December", "
Etiam venenatis enim lorem, non consectetur lectus bibendum id.", "2016-12-05 13:30:00", "considered"),
(4, 2, 1, "Friendly game - November", "Donec convallis dapibus lectus at pellentesque. Integer euismod lectus.", "2016-11-26 13:30:00", "approved");

/*clubimages
*/
INSERT INTO ClubImages (club_id, imagePath, altName)
VALUES (1, "http://www.loupiote.com/photos_l/8137869926-spraying-champagne-sf-giants-fans-celebrating.jpg", "99th Anniversary Party"),
(1, "https://s-media-cache-ak0.pinimg.com/736x/cf/54/9d/cf549dc4e3763bf7130b78cde2240a85.jpg", "Medal Collection"),
(1, "http://news.images.itv.com/image/file/483492/stream_img.jpg", "Member photo"),
(2, "https://upload.wikimedia.org/wikipedia/en/4/4a/The_Narrator_(Edward_Norton,_left)_and_Tyler_Durden_(Brad_Pitt,_right)_from_Fight_Club_(1999).jpg", "Administrators"),
(2, "https://usatmmajunkie.files.wordpress.com/2016/07/rafael-dos-anjos-eddie-alvarez-ufc-fight-night-90.jpg?w=1000&h=600&crop=1", "Fight Night 100-1"),
(2, "http://fightforchildren.org/wp-content/uploads/2015/03/FN2014-1880-e1435342409352.jpg", "Fight Nigh 100-2"),
(3, "http://d2tbfnbweol72x.cloudfront.net/wp-content/blogs.dir/2749/files/2014/10/slide1_08.jpg", "Location"),
(3, "http://www.aberdaregolfclub.co.uk/media/1004/members-fp.jpg", "Members"),
(3, "http://www.ellievangolfclassic.com/uploads/monthly_2016_07/large.887489_799985470108298_4395760381390587650_o.jpg.0095286108ffb535389cfab9cc7915e8.jpg", "After game"),
(4, "http://www.penalty-kick.com/upload/team/1441116703poland.jpg", "Team 2016"),
(4, "http://www.thesoccerstore.co.uk/blog/wp-content/uploads/Football-training.jpg", "Training"),
(4, "http://i.dailymail.co.uk/i/pix/2011/05/04/article-1383559-019039FA000004B0-40_634x418.jpg", "Fans");

/*healthnews
--TODO add description, confirm status values
*/
INSERT INTO HealthNews (user_id, approvedBy, title, description, newsDate, status)
VALUES (1, 1, "Welcome!", "Praesent at justo vitae urna commodo tempor. Aliquam id convallis tellus. Ut rutrum eu nisi a dignissim. Quisque et accumsan neque, id lobortis purus. Vivamus a quam laoreet, porttitor elit a, auctor diam. Quisque at mollis sem. Aliquam blandit tincidunt nisl, eget consectetur lectus porta id. Donec magna eros, gravida ac turpis nec, finibus eleifend lacus. Integer tincidunt sollicitudin felis eu venenatis. Integer tempus, enim eget ornare euismod, risus justo pellentesque erat, id posuere quam arcu vel diam. Phasellus ut hendrerit lectus. Maecenas in mi a dui efficitur egestas ac molestie lacus. Aenean eleifend placerat nibh volutpat porttitor. Etiam congue rutrum ligula. Duis nisi ipsum, tincidunt quis ultrices vitae, maximus vitae sapien. Sed bibendum sollicitudin ex, et hendrerit sem pharetra non.

Aliquam erat volutpat. In non mauris convallis, vulputate odio non, aliquam mauris. Morbi sit amet dolor augue. Donec quis sapien et ante pharetra maximus. Vestibulum a rutrum magna. Vivamus vitae aliquam risus. Vestibulum nisl neque, lobortis sed ante vitae, luctus posuere mauris. Morbi finibus ligula eget feugiat sagittis. Ut imperdiet mauris in leo gravida maximus. Mauris libero magna, dapibus nec consectetur id, commodo at lacus. Nam lacinia nisi ac mollis ullamcorper. Morbi et nulla cursus nulla imperdiet eleifend. Proin pellentesque porttitor risus, a efficitur tortor imperdiet ac.", "2016-11-20 12:05:36", "approved"),
(2, 1, "Great places to visit", "Nullam pulvinar sapien quis dolor placerat luctus. Vivamus vel ullamcorper nulla, sit amet pretium massa. Donec luctus sollicitudin sagittis. Aliquam ut erat et arcu lacinia tincidunt id vitae ante. Cras gravida vehicula elit a convallis. Pellentesque et mi consequat, commodo purus ut, gravida nisl. Nullam rhoncus, neque in consequat tempor, quam quam sagittis lacus, quis dapibus dolor lacus id sapien. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, quam et porttitor fringilla, tortor nunc malesuada tortor, sit amet egestas lacus erat venenatis lorem. Aliquam nec fringilla dolor. Nulla sed lectus at nunc accumsan finibus ornare ut sapien. Praesent et arcu non justo varius euismod. Ut feugiat magna nulla, et gravida nunc venenatis a. Ut quis turpis et nulla finibus lacinia. Mauris ac convallis ex, at lacinia eros.", "2016-11-20 13:33:08", "approved"),
(3, 1, "Upcoming events", "Phasellus interdum erat sed dolor vulputate ultrices. Morbi vehicula ipsum nisl, ac egestas lorem lobortis a. Cras auctor lorem elementum lectus suscipit, eget placerat orci condimentum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Phasellus felis nisi, faucibus et erat ac, dignissim dignissim lectus. Integer eu magna sagittis odio posuere consequat. Pellentesque vehicula vel mi eu rhoncus. In eu nibh laoreet eros vestibulum feugiat ac eu nibh. Integer gravida laoreet justo ac semper. Phasellus et sodales risus. Curabitur interdum est id scelerisque sodales. Donec ut cursus nulla, eu porttitor magna. Phasellus nibh erat, varius nec ipsum sit amet, ullamcorper rutrum sapien. Vivamus auctor massa sem, a scelerisque est finibus eget. Pellentesque at molestie massa, at vehicula lorem.", "2016-11-21 16:52:31", "approved"),
(7, 1, "Eating healthy - cheap!", "Maecenas pellentesque tincidunt lectus at cursus. Nulla pellentesque hendrerit diam, ut tristique augue euismod id. Nulla vulputate lorem a mattis fringilla. Donec mattis aliquet sapien eget rhoncus. Curabitur ut dignissim nisi. Etiam tincidunt sapien vel hendrerit egestas. Quisque pretium feugiat nulla ac commodo. Pellentesque convallis ante et neque varius venenatis ut at velit. Vestibulum sapien risus, consequat sed nisl rhoncus, egestas placerat ante. Aliquam nisl nunc, sollicitudin nec lobortis a, pretium a nulla. Fusce condimentum ipsum ullamcorper, consequat risus id, aliquet lectus. Suspendisse vitae tincidunt orci.

Integer faucibus eleifend ipsum nec congue. Etiam lectus sem, accumsan a risus id, volutpat accumsan massa. In suscipit, felis non aliquam dignissim, justo ex auctor enim, vel ullamcorper velit nibh a enim. Etiam scelerisque eu magna ac dapibus. Curabitur vel augue volutpat, commodo mauris sed, laoreet nisl. Praesent nisl tortor, tincidunt sit amet tincidunt vel, vulputate ut erat. In viverra eleifend sodales. Nunc ut mi id libero consectetur tristique non et sem.

Cras a dictum mi, sed sodales metus. Nunc sodales, tortor vitae tincidunt vestibulum, purus leo rutrum dolor, vel gravida ex nulla vel orci. Nullam sollicitudin libero purus, quis luctus nibh fringilla id. Integer leo magna, tempus ac mollis at, tristique ac leo. Donec id tristique arcu, et feugiat nisi. Aenean tempus urna vel arcu ullamcorper, at pulvinar lectus fringilla. Integer placerat lacus id dignissim tincidunt. Suspendisse ut arcu ac elit elementum tincidunt. Curabitur molestie erat nunc, a consequat ipsum malesuada at. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum neque turpis, pretium id sapien et, euismod sollicitudin dolor. Phasellus ultricies sed mauris quis cursus. Etiam ut augue ex. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed quis arcu lobortis, gravida felis sit amet, accumsan mi.

Proin dapibus aliquet tortor. Sed vitae lobortis massa, sit amet pellentesque tellus. Vestibulum condimentum sem diam, quis tristique urna tincidunt et. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec feugiat accumsan fermentum. Cras id tortor at ex cursus vehicula sed et nunc. Nulla nisl orci, sagittis et feugiat at, gravida et nisl. Sed tempus leo in justo suscipit eleifend. Ut augue felis, tincidunt non gravida quis, feugiat quis orci. Aenean leo dolor, hendrerit eu tellus ut, maximus viverra nulla.

Sed eget lacus lobortis, accumsan mauris ut, malesuada sapien. Integer vel quam justo. Sed mollis risus nulla. Fusce congue mi nunc, in tristique lacus eleifend ut. Cras in ipsum at leo bibendum condimentum. Phasellus at orci nisl. Nam varius quam et eros pretium euismod.", "2016-11-22 10:07:51", "approved"),
(6, NULL, "Excercise tips", "Maecenas eu augue in odio ultricies finibus. Sed vitae ipsum eu nunc euismod laoreet eget facilisis dui. Proin malesuada maximus sem. Fusce vehicula sapien erat, in rhoncus ex dapibus sit amet. Etiam iaculis arcu et mi maximus, quis vehicula neque consectetur. Donec non gravida mauris, nec rutrum ante. Curabitur pretium magna vel ultricies vulputate. Phasellus eu eros eget turpis posuere aliquet eget at neque. Nam pretium nisl in nibh aliquam, non vulputate lectus accumsan. Sed in finibus elit, non luctus lacus. Ut sit amet elit faucibus, facilisis nibh nec, porttitor enim.

Morbi efficitur quis lorem non auctor. Pellentesque pulvinar, neque sit amet bibendum molestie, nisl mi auctor massa, quis iaculis dui urna nec velit. Aliquam sed erat quis nulla facilisis volutpat. Duis at ligula non velit aliquet interdum. Donec vulputate sollicitudin ipsum, in rutrum felis posuere quis. Curabitur id gravida enim, nec ultrices neque. Praesent ac diam aliquam, bibendum massa a, posuere eros. Maecenas semper nulla ut nulla malesuada, in sodales erat laoreet. Nulla eleifend blandit semper. Integer felis dui, consectetur et dui sed, porttitor rutrum eros.

In eu sollicitudin ante. Sed a aliquam tellus. Aenean dolor nunc, mattis at ipsum sed, sodales volutpat lectus. Vestibulum viverra finibus turpis, vitae sagittis dolor porttitor vel. Maecenas pretium turpis id odio cursus aliquet. Aliquam auctor molestie nibh, sed fermentum dui pharetra vel. Vestibulum viverra laoreet risus, ut gravida nisi faucibus ut. Praesent tortor risus, sagittis ut imperdiet id, congue ut nunc. Suspendisse et nisl eu purus tincidunt tempus. Ut et pellentesque magna. Cras non porttitor nunc, et pharetra justo. Nunc condimentum vitae nibh vel interdum.

Praesent at rutrum sapien, sit amet iaculis mi. In eleifend dictum mauris vitae placerat. Fusce iaculis lectus varius, tristique massa sit amet, sagittis arcu. Aliquam nec orci in risus tristique ornare a eu sem. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam rhoncus, nisl ut volutpat imperdiet, diam magna eleifend nunc, eu aliquet lorem turpis consectetur ex. Curabitur pulvinar ut tortor a aliquet. Donec id enim ac odio ornare facilisis nec in mi. Nunc ut magna sit amet erat suscipit ornare id id sapien.", "2016-11-22 13:24:41", "considered"),
(7, NULL, "Choosing winter footwear", "Vestibulum libero nisl, vulputate id venenatis id, luctus sit amet neque. Donec venenatis mi ut ligula gravida, eget faucibus ipsum scelerisque. Nam vitae imperdiet ex. Proin ornare sapien sed velit commodo auctor. Praesent ligula sapien, accumsan non blandit id, pellentesque vitae nibh. Duis viverra mauris at semper vestibulum. Sed a orci dolor. Vivamus ac neque auctor, venenatis ipsum vitae, feugiat nisl. Pellentesque et libero euismod, pretium sapien eget, auctor leo. Aenean tempus leo vel pellentesque imperdiet. Maecenas molestie urna quis pretium rhoncus. Phasellus vestibulum leo ut tellus pharetra vestibulum. Curabitur cursus vehicula turpis ultricies blandit.

Suspendisse accumsan massa ut lectus pharetra, vitae imperdiet libero ultrices. Aliquam non velit id lacus hendrerit ultricies. Sed malesuada porta tortor. Suspendisse venenatis justo ut orci vehicula luctus. Maecenas congue dignissim euismod. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sit amet ligula ac ante suscipit porta in vehicula purus. Phasellus nec sagittis tellus, a vestibulum purus. Nunc libero enim, condimentum dapibus dolor faucibus, tempus porttitor eros. Suspendisse eu tellus lectus.

Morbi ac tellus nec lacus fringilla imperdiet a vitae ex. Morbi sed sagittis tellus. Sed id velit dui. Nam ornare viverra est, nec accumsan magna egestas at. Proin sed tortor vitae sapien tincidunt interdum. Quisque laoreet ipsum quam, vitae blandit sem laoreet eu. Sed ornare nulla ex, vitae efficitur ligula elementum aliquet. Aliquam erat volutpat. Etiam mattis quam eu felis mollis porta. Aenean ultricies accumsan odio tempus lacinia. Suspendisse metus lacus, posuere sit amet arcu sed, feugiat condimentum ligula. Praesent rhoncus odio sem, dictum congue felis porta vitae. Nullam tincidunt ac est pretium elementum. Morbi malesuada posuere sem, vel tincidunt ligula laoreet ac.

Nunc vehicula gravida dui, et viverra mi cursus quis. In hac habitasse platea dictumst. Donec eleifend fringilla sapien eu tincidunt. Quisque ac mi sit amet metus varius ultrices ut nec lectus. Proin pulvinar, urna et finibus sagittis, justo ex lobortis odio, vulputate tempor justo nisl vitae velit. Curabitur quam arcu, pretium at ipsum maximus, congue gravida arcu. Suspendisse in commodo mauris, ut pellentesque arcu. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nam semper sodales justo, pretium elementum risus auctor sit amet. Vestibulum porta convallis leo ut mollis. Phasellus eleifend lacus id sem accumsan tempor. Proin facilisis diam eget egestas volutpat.", "2016-11-22 14:53:15", "considered");

/*healthmedia
*/
INSERT INTO HealthMedia (news_id, mediaType, altName, mediaPath)
VALUES (1, "image", "Welcome", "http://enigmalighting.com/wp-content/uploads/2016/01/welcome-stagma-world1.jpg"),
(2, "image", "View", "http://bestlosangelessightseeingtours.com/images/hollywood-hills-sunset-hike.jpg"),
(3, "video", "Golf", "https://www.youtube.com/watch?v=vCFAdj-mHKQ"),
(4, "image", "Food", "http://www.thefitindian.com/wp-content/uploads/2013/03/natural-and-heatlhy-food.jpg"),
(5, "video", "Motivation", "https://www.youtube.com/watch?v=gocClPWVKIA"),
(6, "image", "Boots", "http://pop.h-cdn.co/assets/cm/15/05/54cb612975602_-_seven-boots-02-1013-lgn.jpg");

/*locations
status missing??
*/
INSERT INTO Locations (user_id, approvedBy, name, description, longitude, latitude, address)
VALUES (2, 2, "Portlethen Train Station", "", 57.061538, -2.128038, "Portlethen, Aberdeen AB12 4JS"),
(2, 2, "Asda Portlethen Superstore", "", 57.063107, -2.140097, "Muirend Rd, Portlethen AB12 4XP"),
(9, 2, "Random Rock", "", 57.062372, -2.132270, "Dunvegan Avenue, Portlethen, Aberdeen AB12 4QE, UK"),
(9, NULL, "Old House", "", 57.060047, -2.129781, "Bruntland Road, Portlethen, Aberdeen AB12 4UT, UK"),
(7, NULL, "Nice Tree", "", 57.057422, -2.130447, "Portlethen Community Woodland Park"),
(1, 1, "Nice Bush", "", 57.056833, -2.130876, "Portlethen Community Woodland Park");

/*locationimages
*/
INSERT INTO LocationImages (loc_id, imagePath, altName)
VALUES (1, "https://upload.wikimedia.org/wikipedia/commons/9/9e/Train_station_Berlin-Spandau.jpg", "Train Station"),
(2, "http://s0.geograph.org.uk/geophotos/01/20/53/1205392_f13c1170.jpg", "Superstore"),
(3, "http://img08.deviantart.net/3fed/i/2011/180/2/e/living_under_a_rock_by_lorainz-d3kh26b.jpg", "Rock"),
(4, "https://upload.wikimedia.org/wikipedia/commons/4/4e/A_house_on_Lincoln_Ave,_Amherst_MA.jpg", "House"),
(5, "http://blog.greatgardensupply.com/wp-content/uploads/2013/08/Tree.jpg", "Tree"),
(6, "http://img.huffingtonpost.com/asset/scalefit_630_noupscale/55b905ae1d00002f0014327b.jpeg", "Bush");

/*Routes
status missing?
should add description field?
approvedby cannot be null????
individual values separated by "," and coordinates separated by ";"
*/
INSERT INTO Routes (user_id, approvedBy, name, coordinates)
VALUES (2, 2, "Arrival Route", "57.061538, -2.128038; 57.063107, -2.140097; 57.062372, -2.132270;"),
(4, 1, "Departue Route", "57.053917, -2.126306; 57.053348, -2.128666; 57.057050, -2.133601; 57.058754, -2.133998; 57.061538, -2.128038"),
(6, 2, "Walking trail", "57.063613, -2.120223; 57.063759, -2.117262; 57.062802, -2.116929; 57.062720, -2.120298; 57.063613, -2.120223");
