This is a car management application which supports CRUD operations based on a RESTAPI. The design is done through Vuejs.

Credentials:

1. username: username, password: password -> role: Admin
2. username: paxer2k, password: password -> role: User

In short, the users are only allowed to create their own cars. If they want to edit or delete the cars, it has to be done through the role on Admin. Additionally, the users can only access their own cars and not the cars of others, this also counts for viewing them (GET).

Admins have the ability, to add, remove and edit the cars. Furthermore, they also can view and change everyone's cars and they can add a car for another user as long as they provide an ID related to that user.