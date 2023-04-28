CREATE TABLE "roles" (
	"id" serial NOT NULL,
	"role_name" varchar(255) NOT NULL UNIQUE,
	CONSTRAINT "PK_Roles" PRIMARY KEY ("id")
);

CREATE TABLE "users" (
	"id" serial NOT NULL,
	"firstname" varchar(255) NOT NULL,
	"patronymic" varchar(255),
	"surname" varchar(255) NOT NULL,
	"login" varchar(255) NOT NULL UNIQUE,
	"password" varchar(255) NOT NULL,
	"email" varchar(255) NOT NULL UNIQUE,
	"role_id" int NOT null default 1,
	CONSTRAINT "PK_Users" PRIMARY KEY ("id"),
	CONSTRAINT "FK_Users_Roles" FOREIGN KEY ("role_id") REFERENCES "roles"("id")
	on update cascade on delete set default
);

CREATE TABLE "categories" (
	"id" serial NOT NULL,
	"categoty_name" varchar(255) NOT NULL UNIQUE,
	CONSTRAINT "PK_Categories" PRIMARY KEY ("id")
);

CREATE TABLE "posts" (
	"id" serial NOT NULL,
	"post_title" text NOT NULL,
	"post_text" text NOT NULL,
	"author_id" int NOT NULL,
	"category_id" int NOT NULL,
	CONSTRAINT "PK_Posts" PRIMARY KEY ("id"),
	CONSTRAINT "FK_Posts_Users" FOREIGN KEY ("author_id") REFERENCES "users"("id")
	on update cascade on delete cascade,
	CONSTRAINT "FK_Posts_Categories" FOREIGN KEY ("category_id") REFERENCES "categories"("id")
	on update cascade on delete cascade
);

CREATE TABLE "comments" (
	"id" serial NOT NULL,
	"comment_text" varchar(255) NOT NULL,
	"post_id" int NOT NULL,
	"comment_author_id" int NOT NULL,
	CONSTRAINT "PK_Comments" PRIMARY KEY ("id"),
	CONSTRAINT "FK_Comments_Posts" FOREIGN KEY ("post_id") REFERENCES "posts"("id")
	on update cascade on delete cascade,
	CONSTRAINT "FK_Comments_Users" FOREIGN KEY ("comment_author_id") REFERENCES "users"("id")
	on update cascade on delete cascade
);



CREATE TABLE "images" (
	"id" serial NOT NULL,
	"post_id" integer NOT NULL,
	"image" bytea NOT NULL,
	CONSTRAINT "PK_Images" PRIMARY KEY ("id"),
	CONSTRAINT "FK_Images_Posts" FOREIGN KEY ("post_id") REFERENCES "posts"("id")
	on update cascade on delete cascade
);