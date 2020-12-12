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
5. Postman

## How to Use
1. Clone this repository to your desired location.
2. Generate application key `php artisan key:generate` and configure it on `.env` file.
3. Create database `kelasan_sandbox` and configure it on `.env` file.
4. Run migration `php artisan migrate`.
5. Run seeder `php artisan db:seed`.
6. Run server `php artisan serve`.
7. Fire-up Postman.
8. Do-what-you-want-with-it!

## Endpoints
### GET
| URL                                                                      | Description                    | Param | Return Type |
|--------------------------------------------------------------------------|--------------------------------|-------|-------------|
| `/api/v1/classrooms/{classroom_id}`                                      | Show classroom detail          |       |             |
| `/api/v1/classrooms/{classroom_id}/invitation-code`                      | Show classroom invitation code |       |             |
| `/api/v1/classrooms/{classroom_id}/assignments`                          | Show classroom assignments     |       |             |
| `/api/v1/classrooms/{classroom_id}/members`                              | Show classroom members         |       |             |
| `/api/v1/classrooms/{classroom_id}/notes`                                | Show classroom notes           |       |             |
| `/api/v1/classrooms/{classroom_id}/subjects`                             | Show classroom subjects        |       |             |
| `/api/v1/classrooms/{classroom_id}/assignments/{assignment_id}`          | Show assignment detail         |       |             |
| `/api/v1/classrooms/{classroom_id}/assignments/{assignment_id}/status`   | Show assignment status         |       |             |
| `/api/v1/classrooms/{classroom_id}/assignments/{assignment_id}/timeline` | Show assignment timeline       |       |             |
| `/api/v1/classrooms/{classroom_id}/notes/{note_id}`                      | Show note detail               |       |             |
| `/api/v1/classrooms/{classroom_id}/notes/{note_id}/timeline`             | Show note timeline             |       |             |
| `/api/v1/classrooms/{classroom_id}/subjects/{subject_id}`                | Show subject detail            |       |             |
| `/api/v1/classrooms/{classroom_id}/subjects/{subject_id}/assignments`    | Show subject assignments       |       |             |
| `/api/v1/search`                                                         | Search data                    |       |             |
| `/api/v1/users/self`                                                     | Show self profile detail       |       |             |
| `/api/v1/users/self/assignments`                                         | Show self profile assignments  |       |             |
| `/api/v1/users/self/classrooms`                                          | Show self profile classrooms   |       |             |
| `/api/v1/users/self/subjects`                                            | Show self profile subjects     |       |             |

### POST
| URL                                             | Description       | Param | Return Type |
|-------------------------------------------------|-------------------|-------|-------------|
| `/api/v1/classrooms`                            | Create classroom  |       |             |
| `/api/v1/classrooms/join`                       | Join classroom    |       |             |
| `/api/v1/classrooms/{classroom_id}/assignments` | Create assignment |       |             |
| `/api/v1/classrooms/{classroom_id}/notes`       | Create note       |       |             |
| `/api/v1/classrooms/{classroom_id}/subjects`    | Create subject    |       |             |
| `/api/v1/users/sign-up`                         | Sign up           |       |             |
| `/api/v1/users/sign-in`                         | Sign in           |       |             |

### PUT
| URL                                                                           | Description              | Param | Return Type |
|-------------------------------------------------------------------------------|--------------------------|-------|-------------|
| `/api/v1/classrooms/{classroom_id}`                                           | Rename classroom         |       |             |
| `/api/v1/classrooms/{classroom_id}/assignments/{assignment_id}`               | Update assignment        |       |             |
| `/api/v1/classrooms/{classroom_id}/assignments/{assignment_id}/change-status` | Change assignment status |       |             |
| `/api/v1/classrooms/{classroom_id}/notes/{note_id}`                           | Update note              |       |             |
| `/api/v1/classrooms/{classroom_id}/subjects/{subject_id}`                     | Rename subject           |       |             |
| `/api/v1/users/self`                                                          | Update self profile      |       |             |

### DELETE
| URL                                                             | Description       | Param | Return Type |
|-----------------------------------------------------------------|-------------------|-------|-------------|
| `/api/v1/classrooms/{classroom_id}/assignments/{assignment_id}` | Remove assignment |       |             |
| `/api/v1/classrooms/{classroom_id}/notes/{note_id}`             | Remove note       |       |             |
| `/api/v1/classrooms/{classroom_id}/subjects/{subject_id}`       | Remove subject    |       |             |
| `/api/v1/users/self/sign-out`                                   | Sign out          |       |             |

## TODOs
- [x] Delete user related boilerplate
- [x] Create base migrations
  - [x] user
  - [x] classroom
  - [x] class_member
  - [x] subject
  - [x] assignment
  - [x] assignment_attachment
  - [x] assignment_status
  - [x] assignment_timeline
  - [x] note
  - [x] note_attachment
  - [x] note_timeline
- [x] Create base models
  - [x] Assignment
  - [x] AssignmentAttachment
  - [x] AssignmentStatus
  - [x] AssignmentTimeline
  - [x] ClassMember
  - [x] Classroom
  - [x] Note
  - [x] NoteAttachment
  - [x] NoteTimeline
  - [x] Subject
  - [x] User
- [x] Create base controllers
  - [x] AssignmentController
  - [x] ClassroomController
  - [x] NoteController
  - [x] SearchController
  - [x] SubjectController
  - [x] UserController
- [x] Create base factories
  - [x] AssignmentAttachmentFactory
  - [x] AssignmentFactory
  - [x] AssignmentStatusFactory
  - [x] AssignmentTimelineFactory
  - [x] ClassMemberFactory
  - [x] ClassroomFactory
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
  - [x] ClassMemberSeeder
  - [x] ClassroomSeeder
  - [x] NoteAttachmentSeeder
  - [x] NoteSeeder
  - [x] NoteTimelineSeeder
  - [x] SubjectSeeder
  - [x] UserSeeder
- [x] Create base middleware
  - [x] ClassroomLeader
  - [x] ClassroomMember
  - [x] NotClassroomMember
- [x] Create endpoints
  - [x] GET Classroom detail
  - [x] GET Classroom invitation code
  - [x] GET Classroom assignments
  - [x] GET Classroom members
  - [x] GET Classroom notes
  - [x] GET Classroom subjects
  - [x] GET Assignment detail
  - [x] GET Assignment status
  - [x] GET Assignment timeline
  - [x] GET Note detail
  - [x] GET Note timeline
  - [x] GET Subject detail
  - [x] GET Subject assignments
  - [x] GET Search data
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
  - [x] DELETE Remove assignment
  - [x] DELETE Remove note
  - [x] DELETE Remove subject
  - [x] DELETE Sign out
- [ ] Fill base migrations
  - [ ] user
  - [ ] classroom
  - [ ] class_member
  - [ ] subject
  - [ ] assignment
  - [ ] assignment_attachment
  - [ ] assignment_status
  - [ ] assignment_timeline
  - [ ] note
  - [ ] note_attachment
  - [ ] note_timeline
- [ ] Fill base controllers
  - [ ] `0/7` AssignmentController
  - [ ] `0/9` ClassroomController
  - [ ] `0/5` NoteController
  - [ ] `0/1` SearchController
  - [ ] `0/5` SubjectController
  - [ ] `0/8` UserController
- [ ] Fill base models
  - [ ] Assignment
  - [ ] AssignmentAttachment
  - [ ] AssignmentStatus
  - [ ] AssignmentTimeline
  - [ ] ClassMember
  - [ ] Classroom
  - [ ] Note
  - [ ] NoteAttachment
  - [ ] NoteTimeline
  - [ ] Subject
  - [ ] User
- [ ] Fill base middleware
  - [ ] ClassroomLeader
  - [ ] ClassroomMember
  - [ ] NotClassroomMember
- [ ] Fill base factories
  - [ ] AssignmentFactory
  - [ ] AssignmentAttachmentFactory
  - [ ] AssignmentStatusFactory
  - [ ] AssignmentTimelineFactory
  - [ ] ClassMemberFactory
  - [ ] ClassroomFactory
  - [ ] NoteFactory
  - [ ] NoteAttachmentFactory
  - [ ] NoteTimelineFactory
  - [ ] SubjectFactory
  - [ ] UserFactory
- [ ] Fill base seeders
  - [ ] AssignmentSeeder
  - [ ] AssignmentAttachmentSeeder
  - [ ] AssignmentStatusSeeder
  - [ ] AssignmentTimelineSeeder
  - [ ] ClassMemberSeeder
  - [ ] ClassroomSeeder
  - [ ] NoteSeeder
  - [ ] NoteAttachmentSeeder
  - [ ] NoteTimelineSeeder
  - [ ] SubjectSeeder
  - [ ] UserSeeder
