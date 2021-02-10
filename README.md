# PHP - Laravel - Kelasan API
**EN**: API for managing class homeworks and notes.

**ID**: API untuk mengelola tugas dan catatan kelas.

## Status
DEVELOPING

## Requirements
1. PHP
2. Composer
3. Laravel
4. MySQL
5. XAMPP
6. Postman

## How to Use
1. Clone this repository to your desired location.
2. Copy `.env.example` file to `.env`.
3. Generate application key `php artisan key:generate`.
4. Generate storage symbolic link `php artisan storage:link`.
5. Create database `kelasan_sandbox` and configure it on `.env` file.
6. Run migration `php artisan migrate`.
7. Run seeder `php artisan db:seed`.
8. Run server `bash server.sh --start`.
9. Fire-up Postman.
10. Do-what-you-want-with-it!

## Endpoints
### GET
| URL                                                                 | Description                    |
|---------------------------------------------------------------------|--------------------------------|
| `/api/v1/classrooms/{classroom}`                                    | Show classroom detail          |
| `/api/v1/classrooms/{classroom}/invitation-code`                    | Show classroom invitation code |
| `/api/v1/classrooms/{classroom}/assignments`                        | Show classroom assignments     |
| `/api/v1/classrooms/{classroom}/notes`                              | Show classroom notes           |
| `/api/v1/classrooms/{classroom}/subjects`                           | Show classroom subjects        |
| `/api/v1/classrooms/{classroom}/users`                              | Show classroom users           |
| `/api/v1/classrooms/{classroom}/assignments/{assignment}`           | Show assignment detail         |
| `/api/v1/classrooms/{classroom}/assignments/{assignment}/statuses`  | Show assignment statuses       |
| `/api/v1/classrooms/{classroom}/assignments/{assignment}/timelines` | Show assignment timelines      |
| `/api/v1/classrooms/{classroom}/notes/{note}`                       | Show note detail               |
| `/api/v1/classrooms/{classroom}/notes/{note}/timelines`             | Show note timelines            |
| `/api/v1/classrooms/{classroom}/subjects/{subject}`                 | Show subject detail            |
| `/api/v1/classrooms/{classroom}/subjects/{subject}/assignments`     | Show subject assignments       |
| `/api/v1/users/self`                                                | Show self detail               |
| `/api/v1/users/self/assignments`                                    | Show self assignments          |
| `/api/v1/users/self/classrooms`                                     | Show self classrooms           |
| `/api/v1/users/self/notes`                                          | Show self notes                |
| `/api/v1/users/self/subjects`                                       | Show self subjects             |

### POST
| URL                                          | Description       |
|----------------------------------------------|-------------------|
| `/api/v1/classrooms`                         | Create classroom  |
| `/api/v1/classrooms/join`                    | Join classroom    |
| `/api/v1/classrooms/{classroom}/assignments` | Create assignment |
| `/api/v1/classrooms/{classroom}/notes`       | Create note       |
| `/api/v1/classrooms/{classroom}/subjects`    | Create subject    |
| `/api/v1/users/sign-up`                      | Sign up           |
| `/api/v1/users/sign-in`                      | Sign in           |

### PUT
| URL                                                                     | Description              |
|-------------------------------------------------------------------------|--------------------------|
| `/api/v1/classrooms/{classroom}`                                        | Update classroom         |
| `/api/v1/classrooms/{classroom}/assignments/{assignment}`               | Update assignment        |
| `/api/v1/classrooms/{classroom}/assignments/{assignment}/change-status` | Update assignment status |
| `/api/v1/classrooms/{classroom}/notes/{note}`                           | Update note              |
| `/api/v1/classrooms/{classroom}/subjects/{subject}`                     | Update subject           |
| `/api/v1/users/self`                                                    | Update profile           |
| `/api/v1/users/self/change-password`                                    | Update password          |

### DELETE
| URL                                                       | Description             |
|-----------------------------------------------------------|-------------------------|
| `/api/v1/classrooms/{classroom}`                          | Delete classroom        |
| `/api/v1/classrooms/{classroom}/assignments/{assignment}` | Delete assignment       |
| `/api/v1/classrooms/{classroom}/notes/{note}`             | Delete note             |
| `/api/v1/classrooms/{classroom}/subjects/{subject}`       | Delete subject          |
| `/api/v1/users/self/sign-out`                             | Sign out current device |
| `/api/v1/users/self/sign-out-all`                         | Sign out all devices    |

## TODOs
Total Tasks : `324`

Completed Tasks : `299`

Progress : `92.28%`

- [x] Configure app `.env`
- [x] Change app timezone & locale to Indonesian
- [x] Install auth package (Sanctum)
- [x] Log SQL queries
- [x] Configure `$dontFlash` attributes on exception handler & `$except` attributes on TrimStrings middleware
- [x] Handle AuthenticationException class
- [x] Handle NotFoundHttpException class
- [x] Delete user related boilerplate
  - [x] User model
  - [x] User factory
  - [x] users migration
  - [x] password_resets migration
  - [x] failed_jobs migration
- [x] Create base migrations
  - [x] users
  - [x] classrooms
  - [x] classroom_user
  - [x] subjects
  - [x] assignments
  - [x] assignment_images
  - [x] assignment_statuses
  - [x] assignment_timelines
  - [x] notes
  - [x] note_images
  - [x] note_timelines
- [x] Create base models
  - [x] Assignment
  - [x] AssignmentImage
  - [x] AssignmentStatus
  - [x] AssignmentTimeline
  - [x] Classroom
  - [x] ClassroomUser
  - [x] Note
  - [x] NoteImage
  - [x] NoteTimeline
  - [x] Subject
  - [x] User
- [x] Create base controllers
  - [x] AssignmentController
  - [x] AssignmentStatusController
  - [x] ClassroomController
  - [x] NoteController
  - [x] SubjectController
  - [x] UserController
- [x] Create base factories
  - [x] AssignmentFactory
  - [x] AssignmentImageFactory
  - [x] AssignmentStatusFactory
  - [x] AssignmentTimelineFactory
  - [x] ClassroomFactory
  - [x] ClassroomUserFactory
  - [x] NoteFactory
  - [x] NoteImageFactory
  - [x] NoteTimelineFactory
  - [x] SubjectFactory
  - [x] UserFactory
- [x] Create base seeders
  - [x] AssignmentImageSeeder
  - [x] AssignmentSeeder
  - [x] AssignmentStatusSeeder
  - [x] AssignmentTimelineSeeder
  - [x] ClassroomSeeder
  - [x] ClassroomUserSeeder
  - [x] NoteImageSeeder
  - [x] NoteSeeder
  - [x] NoteTimelineSeeder
  - [x] SubjectSeeder
  - [x] UserSeeder
- [x] Create endpoints
  - [x] `GET` Show classroom detail
  - [x] `GET` Show classroom invitation code
  - [x] `GET` Show classroom assignments
  - [x] `GET` Show classroom notes
  - [x] `GET` Show classroom subjects
  - [x] `GET` Show classroom users
  - [x] `GET` Show assignment detail
  - [x] `GET` Show assignment statuses
  - [x] `GET` Show assignment timelines
  - [x] `GET` Show note detail
  - [x] `GET` Show note timelines
  - [x] `GET` Show subject detail
  - [x] `GET` Show subject assignments
  - [x] `GET` Show self detail
  - [x] `GET` Show self assignments
  - [x] `GET` Show self classrooms
  - [x] `GET` Show self notes
  - [x] `GET` Show self subjects
  - [x] `POST` Create classroom
  - [x] `POST` Join classroom
  - [x] `POST` Create assignment
  - [x] `POST` Create note
  - [x] `POST` Create subject
  - [x] `POST` Sign up
  - [x] `POST` Sign in
  - [x] `PUT` Update classroom
  - [x] `PUT` Update assignment
  - [x] `PUT` Update assignment status
  - [x] `PUT` Update note
  - [x] `PUT` Update subject
  - [x] `PUT` Update profile
  - [x] `PUT` Update password
  - [x] `DELETE` Delete classroom
  - [x] `DELETE` Delete assignment
  - [x] `DELETE` Delete note
  - [x] `DELETE` Delete subject
  - [x] `DELETE` Sign out current device
  - [x] `DELETE` Sign out all devices
- [x] Create base middleware
  - [x] BelongToClass
  - [x] ClassroomLeader
  - [x] ClassroomUser
  - [x] JSONHeader
- [x] Register middleware on kernel
- [x] Assign middleware on route
- [x] Create base requests
  - [x] JoinClassroomRequest
  - [x] SignInRequest
  - [x] SignUpRequest
  - [x] StoreAssignmentRequest
  - [x] StoreClassroomRequest
  - [x] StoreNoteRequest
  - [x] StoreSubjectRequest
  - [x] UpdateAssignmentRequest
  - [x] UpdateAssignmentStatusRequest
  - [x] UpdateClassroomRequest
  - [x] UpdateNoteRequest
  - [x] UpdatePasswordRequest
  - [x] UpdateProfileRequest
  - [x] UpdateSubjectRequest
- [x] Create traits
  - [x] FailedFormValidation
  - [x] InvitationCode
  - [x] SerializeDate
- [x] Fill base migrations
  - [x] users
  - [x] classrooms
  - [x] classroom_user
  - [x] subjects
  - [x] assignments
  - [x] assignment_images
  - [x] assignment_statuses
  - [x] assignment_timelines
  - [x] notes
  - [x] note_images
  - [x] note_timelines
- [x] Fill base middleware
  - [x] BelongToClass
  - [x] ClassroomLeader
  - [x] ClassroomUser
  - [x] JSONHeader
- [x] Fill base requests
  - [x] JoinClassroomRequest
  - [x] SignInRequest
  - [x] SignUpRequest
  - [x] StoreAssignmentRequest
  - [x] StoreClassroomRequest
  - [x] StoreNoteRequest
  - [x] StoreSubjectRequest
  - [x] UpdateAssignmentRequest
  - [x] UpdateAssignmentStatusRequest
  - [x] UpdateClassroomRequest
  - [x] UpdateNoteRequest
  - [x] UpdatePasswordRequest
  - [x] UpdateProfileRequest
  - [x] UpdateSubjectRequest
- [x] Fill base models
  - [x] Assignment
    - [x] SoftDeletes trait
    - [x] `$fillable` attributes
    - [x] `$hidden` attributes
    - [x] Events
    - [x] Relationships
    - [x] Accessors
    - [x] Mutator
  - [x] AssignmentImage
    - [x] SoftDeletes trait
    - [x] `$fillable` attributes
    - [x] `$hidden` attributes
    - [x] Events
    - [x] Relationships
    - [x] Accessors
    - [x] Mutator
  - [x] AssignmentStatus
    - [x] SoftDeletes trait
    - [x] `$fillable` attributes
    - [x] `$hidden` attributes
    - [x] Events
    - [x] Relationships
    - [x] Accessors
    - [x] Mutator
  - [x] AssignmentTimeline
    - [x] SoftDeletes trait
    - [x] `$fillable` attributes
    - [x] `$hidden` attributes
    - [x] Events
    - [x] Relationships
    - [x] Accessors
    - [x] Mutator
  - [x] Classroom
    - [x] SoftDeletes trait
    - [x] `$fillable` attributes
    - [x] `$hidden` attributes
    - [x] Events
    - [x] Relationships
    - [x] Accessors
    - [x] Mutator
  - [x] ClassroomUser
    - [x] SoftDeletes trait
    - [x] `$fillable` attributes
    - [x] `$hidden` attributes
    - [x] Events
    - [x] Relationships
    - [x] Accessors
    - [x] Mutator
  - [x] Note
    - [x] SoftDeletes trait
    - [x] `$fillable` attributes
    - [x] `$hidden` attributes
    - [x] Events
    - [x] Relationships
    - [x] Accessors
    - [x] Mutator
  - [x] NoteImage
    - [x] SoftDeletes trait
    - [x] `$fillable` attributes
    - [x] `$hidden` attributes
    - [x] Events
    - [x] Relationships
    - [x] Accessors
    - [x] Mutator
  - [x] NoteTimeline
    - [x] SoftDeletes trait
    - [x] `$fillable` attributes
    - [x] `$hidden` attributes
    - [x] Events
    - [x] Relationships
    - [x] Accessors
    - [x] Mutator
  - [x] Subject
    - [x] SoftDeletes trait
    - [x] `$fillable` attributes
    - [x] `$hidden` attributes
    - [x] Events
    - [x] Relationships
    - [x] Accessors
    - [x] Mutator
  - [x] User
    - [x] SoftDeletes trait
    - [x] `$fillable` attributes
    - [x] `$hidden` attributes
    - [x] Events
    - [x] Relationships
    - [x] Accessors
    - [x] Mutator
- [x] Fill base controllers
  - [x] AssignmentController
    - [x] `show()`
    - [x] `statuses()`
    - [x] `timelines()`
    - [x] `store()`
    - [x] `update()`
    - [x] `destroy()`
  - [x] AssignmentStatusController
    - [x] `__invoke()`
  - [x] ClassroomController
    - [x] `show()`
    - [x] `invitationCode()`
    - [x] `assignments()`
    - [x] `notes()`
    - [x] `subjects()`
    - [x] `users()`
    - [x] `store()`
    - [x] `join()`
    - [x] `update()`
    - [x] `destroy()`
  - [x] NoteController
    - [x] `show()`
    - [x] `timelines()`
    - [x] `store()`
    - [x] `update()`
    - [x] `destroy()`
  - [x] SubjectController
    - [x] `show()`
    - [x] `assignments()`
    - [x] `store()`
    - [x] `update()`
    - [x] `destroy()`
  - [x] UserController
    - [x] `show()`
    - [x] `assignments()`
    - [x] `classrooms()`
    - [x] `notes()`
    - [x] `subjects()`
    - [x] `signUp()`
    - [x] `signIn()`
    - [x] `update()`
    - [x] `changePassword()`
    - [x] `signOut()`
    - [x] `signOutAll()`
- [ ] Fill base factories
  - [ ] AssignmentFactory
  - [ ] AssignmentImageFactory
  - [ ] AssignmentStatusFactory
  - [ ] AssignmentTimelineFactory
  - [ ] ClassroomFactory
  - [ ] ClassroomUserFactory
  - [ ] NoteFactory
  - [ ] NoteImageFactory
  - [ ] NoteTimelineFactory
  - [ ] SubjectFactory
  - [ ] UserFactory
- [ ] Fill base seeders
  - [ ] AssignmentImageSeeder
  - [ ] AssignmentSeeder
  - [ ] AssignmentStatusSeeder
  - [ ] AssignmentTimelineSeeder
  - [ ] ClassroomSeeder
  - [ ] ClassroomUserSeeder
  - [ ] NoteImageSeeder
  - [ ] NoteSeeder
  - [ ] NoteTimelineSeeder
  - [ ] SubjectSeeder
  - [ ] UserSeeder
- [ ] Translate English locale to Indonesian
