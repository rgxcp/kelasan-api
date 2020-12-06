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
| URL | Description | Param | Return Type |
|-----|-------------|-------|-------------|
|     |             |       |             |

### POST
| URL | Description | Param | Return Type |
|-----|-------------|-------|-------------|
|     |             |       |             |

### PUT
| URL | Description | Param | Return Type |
|-----|-------------|-------|-------------|
|     |             |       |             |

### DELETE
| URL | Description | Param | Return Type |
|-----|-------------|-------|-------------|
|     |             |       |             |

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
- [ ] Create base controllers
  - [ ] AssignmentController
  - [ ] AssignmentAttachmentController
  - [ ] AssignmentStatusController
  - [ ] AssignmentTimelineController
  - [ ] ClassMemberController
  - [ ] ClassroomController
  - [ ] NoteController
  - [ ] NoteAttachmentController
  - [ ] NoteTimelineController
  - [ ] SearchController
  - [ ] SubjectController
  - [ ] UserController
- [ ] Create base factories
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
- [ ] Create base seeders
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
- [ ] Create base middleware
  - [ ] ClassroomLeader
  - [ ] ClassroomMember
  - [ ] NotClassroomMember
- [ ] Create endpoints
  - [ ] GET All assignment
  - [ ] GET Today assignment
  - [ ] GET Tomorrow assignment
  - [ ] GET Next week assignment
  - [ ] GET Completed assignment
  - [ ] GET Uncompleted assignment
  - [ ] GET Assignment detail
  - [ ] GET Assignment status
  - [ ] GET Assignment timeline
  - [ ] GET Classroom detail
  - [ ] GET Classroom invitation code
  - [ ] GET Classroom member
  - [ ] GET Classroom subject
  - [ ] GET Classroom assignment
  - [ ] GET Classroom completed assignment
  - [ ] GET Classroom uncompleted assignment
  - [ ] GET Classroom assignment status
  - [ ] GET Classroom note
  - [ ] GET Note detail
  - [ ] GET Note timeline
  - [ ] GET Search by
  - [ ] GET Subject detail
  - [ ] GET Subject assignment
  - [ ] GET Subject completed assignment
  - [ ] GET Subject uncompleted assignment
  - [ ] GET Subject assignment status
  - [ ] GET Self profile detail
  - [ ] GET Self classroom
  - [ ] POST Create assignment
  - [ ] POST Change assignment status
  - [ ] POST Create classroom
  - [ ] POST Join classroom
  - [ ] POST Create note
  - [ ] POST Create subject
  - [ ] POST Sign up
  - [ ] POST Sign in
  - [ ] PUT Update assignment
  - [ ] PUT Rename classroom
  - [ ] PUT Update note
  - [ ] PUT Rename subject
  - [ ] PUT Update self profile
  - [ ] DELETE Remove assignment
  - [ ] DELETE Remove note
  - [ ] DELETE Remove subject
  - [ ] DELETE Sign out
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
  - [ ] AssignmentController
  - [ ] AssignmentAttachmentController
  - [ ] AssignmentStatusController
  - [ ] AssignmentTimelineController
  - [ ] ClassMemberController
  - [ ] ClassroomController
  - [ ] NoteController
  - [ ] NoteAttachmentController
  - [ ] NoteTimelineController
  - [ ] SearchController
  - [ ] SubjectController
  - [ ] UserController
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
