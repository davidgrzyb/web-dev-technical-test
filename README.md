# Full Stack Skill Test

This is a repo containing the separate frontend and backend components of the Full Stack skill test. The backend part of the test has been deployed and can be used by the frontend app once locally installed to pull data.

After migrating and seeding the backend database with the included command, using the route `/api/photographers/1` should provide the same data that is found in `landscapes.json`.

## The Development Process

#### Easy Parts

The easiest part of the development of the apps in this repo was the backend design and implementation. I have strong experience with the MVC structure of Laravel, as well as tools such as tests, Requests, Resources, migrations and query builders (to avoid N+1 problems) that make Laravel a great backend framework.

I also find the Vue CLI to be easy to set up, with the auto-generated structure being a great place to get started. Integrating the TailwindCSS package was also straight forward.

#### Difficult Parts

My experience is much stronger in PHP than in JavaScript, so I had moments where I had to stop and Google certain things to remind myself why one method is better than the other. For example, I remember using axios to get data asynchronously prior to this test, however in the past I used `then()` instead of `async/await`. After some quick Googling, it turns out that `async/await` is a cleaner and more modern way of making asynchronous calls so I went with that even though they are both similar and valid.

Another example is JavaScript's destructuring that I used to get the data out of the response from axios. These little details will become second nature over time, but for now I need to actively remember these ways to clean up my code.

#### Version Control

My typical git workflow starts with pretending that I'm not the only one working on the project. 

This means:
- Make the initial commit to master (in this case a README file).
- Make the rest of the work in separate branches, prefixed by the purpose of the branch (ex. feature, enhancement, fix).
- Create a PR, and make regular commits at milestones when writing code. Use commit messages that are detailed.
- Once a feature is implemented, review the code in the PR. If the code is acceptable, squash the commits with a rebase on master (in this case), and rename the main commit to something that makes sense in the context of the PR.
- Merge the PR.

#### Frontend

The frontend was built with a Vue CLI app as a starting point. I then installed TailwindCSS, configured its PurgeCSS functionality (which is now built in!) and began building out the frontend using Tailwind.

Once complete, I reviewed Vue best practices and decided on storing the test's provided files in the `/assets` directory of the project and using axios to get the data asynchronously. I then implemented the `loading...` text when the data is loading and simple error handling if the data could not be loaded.

#### Backend

For the backend, I created a fresh Laravel 7 application, left all of the configuration and boilerplate at their default values, and started to create migrations and models. I decided to create the Photographer, Gallery and Photo models with their respective migrations, despite Gallery not really having any purpose in this example.

The Gallery has a one-to-one relationship with Photographer, and each Gallery can have many Photos (one-to-many). These relationships were set up using Laravel conventions to ensure eager loading and other Laravel features could be used. Since Gallery is its own model and table, if the app requires that each Photographer needed to have multiple galleries, a simple change in the declared relationships to one-to-many would suffice.

I then created API controllers using artisan, and used some neat routing methods to keep the `api.php` routes file simpler. The initial data after the database is migrated can be seeded by running a command that is detailed in the backend app's README. Once seeded, getting the photographer with an ID of 1 will return the exact data found in `landscapes.json`.

## Tools I Used

#### TailwindCSS

I used TailwindCSS because it's a popular frontend framework for rapidly developing UIs. I used to use Bootstrap frequently, but TailwindCSS allows for much more flexibility, and now includes PurgeCSS out of the box, which is great.

#### Vue CLI

I used Vue.js and the CLI specifically because I have experience with Vue.js and I know that it is the go-to frontend framework when paired with Laravel. I enjoy Vue.js, and find that I like to build apps with Vue more than with React, though that is just personal preference and is mostly based on the biases of already being part of the Laravel community.

#### Laravel

Laravel is my favorite framework for backend development due to its perfect balance of conventions and flexibility, as well as its community. This project is a good example of why Laravel is great. For example, I used eager loading in my controllers to control the format of the JSON output of the API (thanks to `$this->whenLoaded()` in Laravel's resources). If the relationship isn't loaded, the data won't be there, allowing the developer to better control the flow of data and the SQL query load.

## Conclusion

Thank you for taking the time to review my code, I hope to answer any questions you may have about my experience if given the chance to do so.