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
2. Generate application key `php artisan key:generate` and configure it on `.env` file.
3. Create database `kelasan_sandbox` and configure it on `.env` file.
4. Run migration `php artisan migrate`.
5. Run seeder `php artisan db:seed`.
6. Run server `bash server.sh --start`.
7. Fire-up Postman.
8. Do-what-you-want-with-it!

## Endpoints
### GET
| URL                                                                 | Description                    |
|---------------------------------------------------------------------|--------------------------------|
| `/api/v1/classrooms/{classroom}`                                    | Show classroom detail          |
| `/api/v1/classrooms/{classroom}/invitation-code`                    | Show classroom invitation code |
| `/api/v1/classrooms/{classroom}/assignments`                        | Show classroom assignments     |
| `/api/v1/classrooms/{classroom}/members`                            | Show classroom members         |
| `/api/v1/classrooms/{classroom}/notes`                              | Show classroom notes           |
| `/api/v1/classrooms/{classroom}/subjects`                           | Show classroom subjects        |
| `/api/v1/classrooms/{classroom}/assignments/{assignment}`           | Show assignment detail         |
| `/api/v1/classrooms/{classroom}/assignments/{assignment}/statuses`  | Show assignment statuses       |
| `/api/v1/classrooms/{classroom}/assignments/{assignment}/timelines` | Show assignment timelines      |
| `/api/v1/classrooms/{classroom}/notes/{note}`                       | Show note detail               |
| `/api/v1/classrooms/{classroom}/notes/{note}/timelines`             | Show note timelines            |
| `/api/v1/classrooms/{classroom}/subjects/{subject}`                 | Show subject detail            |
| `/api/v1/classrooms/{classroom}/subjects/{subject}/assignments`     | Show subject assignments       |
| `/api/v1/users/self`                                                | Show self profile detail       |
| `/api/v1/users/self/assignments`                                    | Show self profile assignments  |
| `/api/v1/users/self/classrooms`                                     | Show self profile classrooms   |
| `/api/v1/users/self/subjects`                                       | Show self profile subjects     |

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
| `/api/v1/classrooms/{classroom}`                                        | Rename classroom         |
| `/api/v1/classrooms/{classroom}/assignments/{assignment}`               | Update assignment        |
| `/api/v1/classrooms/{classroom}/assignments/{assignment}/change-status` | Change assignment status |
| `/api/v1/classrooms/{classroom}/notes/{note}`                           | Update note              |
| `/api/v1/classrooms/{classroom}/subjects/{subject}`                     | Rename subject           |
| `/api/v1/users/self`                                                    | Update self profile      |
| `/api/v1/users/self/change-password`                                    | Change self password     |

### DELETE
| URL                                                       | Description             |
|-----------------------------------------------------------|-------------------------|
| `/api/v1/classrooms/{classroom}/assignments/{assignment}` | Remove assignment       |
| `/api/v1/classrooms/{classroom}/notes/{note}`             | Remove note             |
| `/api/v1/classrooms/{classroom}/subjects/{subject}`       | Remove subject          |
| `/api/v1/users/self/sign-out`                             | Sign out current device |
| `/api/v1/users/self/sign-out-all`                         | Sign out all devices    |

## TODOs
Total Tasks : `318`

Completed Tasks : `293`

Progress : `92.13%`

- [x] Configure app .env
- [x] Change app timezone & locale
- [x] Install auth package (Sanctum)
- [x] Log SQL queries
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
  - [x] assignment_attachments
  - [x] assignment_statuses
  - [x] assignment_timelines
  - [x] notes
  - [x] note_attachments
  - [x] note_timelines
- [x] Create base models
  - [x] Assignment
  - [x] AssignmentAttachment
  - [x] AssignmentStatus
  - [x] AssignmentTimeline
  - [x] Classroom
  - [x] ClassroomUser
  - [x] Note
  - [x] NoteAttachment
  - [x] NoteTimeline
  - [x] Subject
  - [x] User
- [x] Create base controllers
  - [x] AssignmentController
  - [x] ClassroomController
  - [x] NoteController
  - [x] SubjectController
  - [x] UserController
- [x] Create base factories
  - [x] AssignmentAttachmentFactory
  - [x] AssignmentFactory
  - [x] AssignmentStatusFactory
  - [x] AssignmentTimelineFactory
  - [x] ClassroomFactory
  - [x] ClassroomUserFactory
  - [x] NoteAttachmentFactory
  - [x] NoteFactory
  - [x] NoteTimelineFactory
  - [x] SubjectFactory
  - [x] UserFactory
- [x] Create base seeders
  - [x] AssignmentAttachmentSeeder
  - [x] AssignmentSeeder
  - [x] AssignmentStatusSeeder
  - [x] AssignmentTimelineSeeder
  - [x] ClassroomSeeder
  - [x] ClassroomUserSeeder
  - [x] NoteAttachmentSeeder
  - [x] NoteSeeder
  - [x] NoteTimelineSeeder
  - [x] SubjectSeeder
  - [x] UserSeeder
- [x] Create endpoints
  - [x] GET Classroom detail
  - [x] GET Classroom invitation code
  - [x] GET Classroom assignments
  - [x] GET Classroom members
  - [x] GET Classroom notes
  - [x] GET Classroom subjects
  - [x] GET Assignment detail
  - [x] GET Assignment statuses
  - [x] GET Assignment timelines
  - [x] GET Note detail
  - [x] GET Note timelines
  - [x] GET Subject detail
  - [x] GET Subject assignments
  - [x] GET Self profile detail
  - [x] GET Self profile assignments
  - [x] GET Self profile classrooms
  - [x] GET Self profile subjects
  - [x] POST Create classroom
  - [x] POST Join classroom
  - [x] POST Create assignment
  - [x] POST Create note
  - [x] POST Create subject
  - [x] POST Sign up
  - [x] POST Sign in
  - [x] PUT Rename classroom
  - [x] PUT Update assignment
  - [x] PUT Change assignment status
  - [x] PUT Update note
  - [x] PUT Rename subject
  - [x] PUT Update self profile
  - [x] PUT Change self password
  - [x] DELETE Remove assignment
  - [x] DELETE Remove note
  - [x] DELETE Remove subject
  - [x] DELETE Sign out current device
  - [x] DELETE Sign out all devices
- [x] Create base middleware
  - [x] BelongToClass
  - [x] ClassroomLeader
  - [x] ClassroomUser
  - [x] JSONHeader
- [x] Register middleware on kernel
- [x] Assign middleware on route
- [x] Create base requests
  - [x] ChangePasswordRequest
  - [x] CreateAssignmentRequest
  - [x] CreateClassroomRequest
  - [x] CreateNoteRequest
  - [x] CreateSubjectRequest
  - [x] JoinClassroomRequest
  - [x] RenameClassroomRequest
  - [x] RenameSubjectRequest
  - [x] SignInRequest
  - [x] SignUpRequest
  - [x] UpdateAssignmentRequest
  - [x] UpdateNoteRequest
  - [x] UpdateProfileRequest
- [x] Fill base migrations
  - [x] users
  - [x] classrooms
  - [x] classroom_user
  - [x] subjects
  - [x] assignments
  - [x] assignment_attachments
  - [x] assignment_statuses
  - [x] assignment_timelines
  - [x] notes
  - [x] note_attachments
  - [x] note_timelines
- [x] Fill base middleware
  - [x] BelongToClass
  - [x] ClassroomLeader
  - [x] ClassroomUser
  - [x] JSONHeader
- [x] Fill base requests
  - [x] ChangeAssignmentStatusRequest
  - [x] ChangePasswordRequest
  - [x] CreateAssignmentRequest
  - [x] CreateClassroomRequest
  - [x] CreateNoteRequest
  - [x] CreateSubjectRequest
  - [x] JoinClassroomRequest
  - [x] RenameClassroomRequest
  - [x] RenameSubjectRequest
  - [x] SignInRequest
  - [x] SignUpRequest
  - [x] UpdateAssignmentRequest
  - [x] UpdateNoteRequest
  - [x] UpdateProfileRequest
- [x] Fill base models
  - [x] Assignment
    - [x] SoftDeletes trait
    - [x] `$fillable` attributes
    - [x] `$hidden` attributes
    - [x] Events
    - [x] Relationships
    - [x] Accessors
    - [x] Mutator
  - [x] AssignmentAttachment
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
  - [x] NoteAttachment
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
- [x] Handle AuthenticationException class
- [x] Handle NotFoundHttpException class
- [x] Configure `$dontFlash` attributes on exception handler & `$except` attributes on TrimStrings middleware
- [x] Create traits
  - [x] FailedFormValidation
  - [x] InvitationCode
  - [x] SerializeDate
- [x] Fill base controllers
  - [x] AssignmentController
    - [x] `detail()`
    - [x] `statuses()`
    - [x] `timelines()`
    - [x] `create()`
    - [x] `update()`
    - [x] `delete()`
  - [x] AssignmentStatusController
    - [x] `__invoke()`
  - [x] ClassroomController
    - [x] `detail()`
    - [x] `invitationCode()`
    - [x] `assignments()`
    - [x] `members()`
    - [x] `notes()`
    - [x] `subjects()`
    - [x] `create()`
    - [x] `join()`
    - [x] `rename()`
  - [x] NoteController
    - [x] `detail()`
    - [x] `timelines()`
    - [x] `create()`
    - [x] `update()`
    - [x] `delete()`
  - [x] SubjectController
    - [x] `detail()`
    - [x] `assignments()`
    - [x] `create()`
    - [x] `rename()`
    - [x] `delete()`
  - [x] UserController
    - [x] `detail()`
    - [x] `assignments()`
    - [x] `classrooms()`
    - [x] `subjects()`
    - [x] `signUp()`
    - [x] `signIn()`
    - [x] `update()`
    - [x] `changePassword()`
    - [x] `signOut()`
    - [x] `signOutAll()`
- [ ] Fill base factories
  - [ ] AssignmentAttachmentFactory
  - [ ] AssignmentFactory
  - [ ] AssignmentStatusFactory
  - [ ] AssignmentTimelineFactory
  - [ ] ClassroomFactory
  - [ ] ClassroomUserFactory
  - [ ] NoteAttachmentFactory
  - [ ] NoteFactory
  - [ ] NoteTimelineFactory
  - [ ] SubjectFactory
  - [ ] UserFactory
- [ ] Fill base seeders
  - [ ] AssignmentAttachmentSeeder
  - [ ] AssignmentSeeder
  - [ ] AssignmentStatusSeeder
  - [ ] AssignmentTimelineSeeder
  - [ ] ClassroomSeeder
  - [ ] ClassroomUserSeeder
  - [ ] NoteAttachmentSeeder
  - [ ] NoteSeeder
  - [ ] NoteTimelineSeeder
  - [ ] SubjectSeeder
  - [ ] UserSeeder
- [ ] Translate English locale to Indonesian
