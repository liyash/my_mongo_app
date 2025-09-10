MongoDB (NoSQL) and Symfony Integration
Training & Presentation Document

1. Introduction
MongoDB is one of the most popular NoSQL databases. 
It is designed for handling unstructured and semi-structured data. 
Instead of traditional rows and tables, MongoDB uses a flexible schema and stores data as JSON-like documents (BSON).

Symfony, a popular PHP framework, can integrate MongoDB using Doctrine MongoDB ODM. 
This allows developers to work with documents in an object-oriented way, similar to how they use entities with SQL databases.
2. What is MongoDB?
- Open-source, cross-platform NoSQL database
- Uses collections and documents instead of tables and rows
- Stores data in BSON (Binary JSON)
- Schema-less (flexible structure)
- Highly scalable and distributed

👉 In simple terms, MongoDB is like having a digital filing cabinet where each file (document) can look slightly different, yet all belong to the same drawer (collection).
3. Example MongoDB Document
A typical document looks like JSON:

{
  "name": "Alice",
  "email": "alice@example.com",
  "skills": ["PHP", "Symfony", "MongoDB"]
}

👉 Notice how the fields don’t need to follow a strict structure like in SQL.
4. RDBMS vs MongoDB
| Feature        | RDBMS (MySQL, PostgreSQL) | MongoDB (NoSQL) |
|---------------|--------------------------|----------------|
| Data Structure | Tables, Rows, Columns | Collections, Documents |
| Schema | Fixed | Flexible (schema-less) |
| Joins | Yes | Limited, use embedded docs |
| Transactions | Full ACID | Basic support since v4.0 |
| Scalability | Vertical | Horizontal (sharding, replication) |

👉 MongoDB sacrifices some SQL-style strictness for flexibility and scalability.
5. Why MongoDB?
Advantages of MongoDB:
✅ Flexible schema (great for dynamic apps)
✅ Handles unstructured and semi-structured data
✅ JSON/BSON makes it developer friendly
✅ High availability and horizontal scaling
✅ Easy integration with modern applications

👉 It’s ideal for projects where data requirements change often, like e-commerce product catalogs or user profiles.
6. Symfony & MongoDB Integration
Symfony normally uses Doctrine ORM with SQL databases. 
To connect with MongoDB, we use Doctrine MongoDB ODM (Object Document Mapper).

Steps to integrate:
1. Install the ODM bundle:
   composer require doctrine/mongodb-odm-bundle

2. Configure the .env file:
   MONGODB_URL=mongodb://localhost:27017/mydb

3. Define a Document (similar to an Entity in SQL ORM). Example:

```php
#[ODM\Document]
class User {
    #[ODM\Id]
    private string $id;
    #[ODM\Field(type: 'string')]
    private string $name;
    #[ODM\Field(type: 'string')]
    private string $email;
}
```

4. Create schema:
   php bin/console doctrine:mongodb:schema:create

5. Persist data:
   Use `$dm->persist($user); $dm->flush();` just like Doctrine ORM.

👉 Once integrated, working with MongoDB in Symfony feels natural for PHP developers.
7. Use Cases of MongoDB
- Logging and analytics (large data volumes)
- Product catalogs with flexible attributes
- User sessions and caching
- Real-time apps (chat, IoT)
- Content management systems

👉 Basically, use MongoDB where flexibility and performance matter more than rigid schemas.
8. MongoDB Compass (Filtering & Comparing)
MongoDB Compass provides a GUI for interacting with MongoDB.

Examples of queries:
- Equality: { "name": "Alice" }
- Greater than: { "age": { "$gt": 25 } }
- Range: { "age": { "$gte": 20, "$lte": 30 } }
- OR condition: { "$or": [ { "role": "admin" }, { "role": "editor" } ] }
- Regex: { "email": { "$regex": "gmail.com" } }

👉 This is very useful for training/demo purposes when introducing MongoDB to new developers.
9. Symfony Use Cases with MongoDB
Some scenarios where MongoDB shines with Symfony:
- User profiles with dynamic fields
- Product catalogs with varying attributes
- Logging & analytics
- CMS (content with metadata, comments)
- Real-time apps like chat/IoT

Example: Logging user activity as a Document instead of a SQL table.

👉 Developers can extend Symfony applications more easily without restructuring entire SQL databases.
10. Hands-on: MongoDB Shell Basics
Some common MongoDB commands:

- Switch DB: use mydatabase
- Show collections: show collections
- Insert document: db.mycollection.insertOne({ item: "book", qty: 25 })
- Find all: db.mycollection.find()
- Update: db.mycollection.updateOne({ item: "book" }, { $set: { qty: 26 } })
- Delete: db.mycollection.deleteOne({ item: "pen" })

👉 These basics are important for hands-on training sessions.
11. Conclusion
MongoDB provides flexibility, scalability, and speed where traditional SQL databases may be too rigid. 
Symfony integrates smoothly using Doctrine ODM, enabling developers to build modern, scalable apps.

✅ Use MongoDB when flexibility & scalability matter.
✅ Use SQL when strong consistency and relationships matter.

👉 Both can coexist in hybrid architectures, and Symfony supports both approaches seamlessly.
