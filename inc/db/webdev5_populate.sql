/* Users */
INSERT INTO Users (clubAdmin, nkpag, siteAdmin, username, email, password)
VALUES (0,0,0,"sam12", "robza@sam.com", "password123");

INSERT INTO Users (clubAdmin, nkpag, siteAdmin, username, email, password)
VALUES (1,0,0,"Duntik45", "duntik@duntik.com", "password1232");

INSERT INTO Users (clubAdmin, nkpag, siteAdmin, username, email, password)
VALUES (1,1,0,"vladimip", "vld@marginal.com", "password56");

INSERT INTO Users (clubAdmin, nkpag, siteAdmin, username, email, password)
VALUES (0,0,1,"dsa12", "email@dwe.com", "password886");

/* Clubs */
INSERT INTO Clubs (name, genreCode, description, phone, email, address)
VALUES ("Golf Club","SP","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris laoreet est eget quam ultricies, aliquam dignissim diam porttitor. Fusce facilisis erat urna, at imperdiet lectus pharetra sed. Integer posuere suscipit augue, a consectetur neque pretium et. Nulla nec fermentum arcu, at lacinia sem. Aenean eu eleifend ligula. Nunc id malesuada lectus, vitae efficitur magna. Etiam at ante et metus efficitur laoreet. Nullam dictum quis massa ultrices molestie. Phasellus sed tellus vitae nunc fringilla sagittis quis sed urna. Maecenas malesuada interdum neque nec faucibus. Aenean volutpat felis vitae purus interdum iaculis. Nunc vitae malesuada nulla. Etiam ut ipsum lectus. Phasellus ac maximus lorem, eget egestas nibh. Sed porta augue tempus convallis lobortis.","0122454545400","email@golf.com", "12 F Some Street, Aberdeen, AB99 4SS");

INSERT INTO Clubs (name, genreCode, description, phone, email, address)
VALUES ("Cook Club","HO","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris laoreet est eget quam ultricies, aliquam dignissim diam porttitor. Fusce facilisis erat urna, at imperdiet lectus pharetra sed. Integer posuere suscipit augue, a consectetur neque pretium et. Nulla nec fermentum arcu, at lacinia sem. Aenean eu eleifend ligula. Nunc id malesuada lectus, vitae efficitur magna. Etiam at ante et metus efficitur laoreet. Nullam dictum quis massa ultrices molestie. Phasellus sed tellus vitae nunc fringilla sagittis quis sed urna. Maecenas malesuada interdum neque nec faucibus. Aenean volutpat felis vitae purus interdum iaculis. Nunc vitae malesuada nulla. Etiam ut ipsum lectus. Phasellus ac maximus lorem, eget egestas nibh. Sed porta augue tempus convallis lobortis.","01224776766777","email@cook.com", "126 Someother Street, Aberdeen, AB92 4XX");

/* ClubAdmins */
INSERT INTO ClubAdmins VALUES (2, 1);
INSERT INTO ClubAdmins VALUES (3, 2);