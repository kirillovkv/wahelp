CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    number VARCHAR(50) NOT NULL,
    name VARCHAR(100) NOT NULL
);
CREATE TABLE mailings (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255),
    content TEXT
);

CREATE TABLE sent_messages (
    id SERIAL PRIMARY KEY,
    user_id INT REFERENCES users(id),
    mailing_id INT REFERENCES mailings(id),
    UNIQUE(user_id, mailing_id)
);