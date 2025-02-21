@extends('backend.layout.app')
@section('title', 'Profile Page')
@section('content')
<div class="my-4 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1 class="page-title fw-medium fs-18 mb-2">Profile</h1>
        <div class="">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>
        </div>
    </div>

</div>
<div class="row">
    @include('backend.profile.partials.profileView')
    <div class="col-xl-6">
        <div class="card custom-card">
            <div class="card-header">
                <ul class="nav nav-pills mb-0 gap-2" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link bg-light active" id="profile-about-tab" data-bs-toggle="tab"
                            data-bs-target="#profile-about-tab-pane" type="button" role="tab"
                            aria-controls="profile-about-tab-pane" aria-selected="true"><i
                                class="ri-shield-user-line me-1 fs-16"></i>About</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link bg-light" id="edit-profile-tab" data-bs-toggle="tab"
                            data-bs-target="#edit-profile-tab-pane" type="button" role="tab"
                            aria-controls="edit-profile-tab-pane" aria-selected="true"><i
                                class="ri-edit-box-line me-1 fs-16"></i>Edit
                            Profile</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link bg-light" id="gallery-tab" data-bs-toggle="tab"
                            data-bs-target="#gallery-tab-pane" type="button" role="tab" aria-controls="gallery-tab-pane"
                            aria-selected="false"><i class="ri-image-2-line me-1 fs-16"></i>Gallery</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link bg-light" id="friends-tab" data-bs-toggle="tab"
                            data-bs-target="#friends-tab-pane" type="button" role="tab" aria-controls="friends-tab-pane"
                            aria-selected="false"><i class="ri-group-line me-1 fs-16"></i>Friends</button>
                    </li>
                </ul>
            </div>
            <div class="card-body p-0">
                <div class="tab-content" id="profile-tabs">
                    @include('backend.profile.partials.aboutProfile')
                    <div class="tab-pane p-0 border-0" id="edit-profile-tab-pane" role="tabpanel"
                        aria-labelledby="edit-profile-tab" tabindex="0">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item p-4">
                                        <span class="fw-medium fs-15 d-block mb-3">Personal Info
                                            :</span>
                                        <div class="row gy-4 align-items-center">
                                            <div class="col-xl-3">
                                                <div class="lh-1">
                                                    <span class="fw-medium">User Name :</span>
                                                </div>
                                            </div>
                                            <div class="col-xl-9">
                                                <input type="text" class="form-control" placeholder="Placeholder"
                                                    value="Leo Phillips">
                                            </div>
                                            <div class="col-xl-3">
                                                <div class="lh-1">
                                                    <span class="fw-medium">First Name :</span>
                                                </div>
                                            </div>
                                            <div class="col-xl-9">
                                                <input type="text" class="form-control" placeholder="Placeholder"
                                                    value="Leo">
                                            </div>
                                            <div class="col-xl-3">
                                                <div class="lh-1">
                                                    <span class="fw-medium">Last Name :</span>
                                                </div>
                                            </div>
                                            <div class="col-xl-9">
                                                <input type="text" class="form-control" placeholder="Placeholder"
                                                    value="Phillips">
                                            </div>
                                            <div class="col-xl-3">
                                                <div class="lh-1">
                                                    <span class="fw-medium">Designation :</span>
                                                </div>
                                            </div>
                                            <div class="col-xl-9">
                                                <input type="text" class="form-control" placeholder="Placeholder"
                                                    value="Chief Executive Officer (C.E.O)">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item p-4">
                                        <span class="fw-medium fs-15 d-block mb-3">Contact Info :</span>
                                        <div class="row gy-4 align-items-center">
                                            <div class="col-xl-3">
                                                <div class="lh-1">
                                                    <span class="fw-medium">Email :</span>
                                                </div>
                                            </div>
                                            <div class="col-xl-9">
                                                <input type="email" class="form-control" placeholder="Placeholder"
                                                    value="your.email@example.com">
                                            </div>
                                            <div class="col-xl-3">
                                                <div class="lh-1">
                                                    <span class="fw-medium">Phone :</span>
                                                </div>
                                            </div>
                                            <div class="col-xl-9">
                                                <input type="text" class="form-control" placeholder="Placeholder"
                                                    value="+1 (555) 123-4567">
                                            </div>
                                            <div class="col-xl-3">
                                                <div class="lh-1">
                                                    <span class="fw-medium">Website :</span>
                                                </div>
                                            </div>
                                            <div class="col-xl-9">
                                                <input type="text" class="form-control" placeholder="Placeholder"
                                                    value="www.yourwebsite.com">
                                            </div>
                                            <div class="col-xl-3">
                                                <div class="lh-1">
                                                    <span class="fw-medium">Location :</span>
                                                </div>
                                            </div>
                                            <div class="col-xl-9">
                                                <input type="text" class="form-control" placeholder="Placeholder"
                                                    value="City, Country">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item p-4">
                                        <span class="fw-medium fs-15 d-block mb-3">Social Info :</span>
                                        <div class="row gy-4 align-items-center">
                                            <div class="col-xl-3">
                                                <div class="lh-1">
                                                    <span class="fw-medium">Github :</span>
                                                </div>
                                            </div>
                                            <div class="col-xl-9">
                                                <input type="text" class="form-control" placeholder="Placeholder"
                                                    value="github.com/wcsrm">
                                            </div>
                                            <div class="col-xl-3">
                                                <div class="lh-1">
                                                    <span class="fw-medium">Twitter :</span>
                                                </div>
                                            </div>
                                            <div class="col-xl-9">
                                                <input type="text" class="form-control" placeholder="Placeholder"
                                                    value="twitter.com/wcsrm.html">
                                            </div>
                                            <div class="col-xl-3">
                                                <div class="lh-1">
                                                    <span class="fw-medium">Linkedin :</span>
                                                </div>
                                            </div>
                                            <div class="col-xl-9">
                                                <input type="text" class="form-control" placeholder="Placeholder"
                                                    value="linkedin.com/in/wcsrm">
                                            </div>
                                            <div class="col-xl-3">
                                                <div class="lh-1">
                                                    <span class="fw-medium">Portfolio :</span>
                                                </div>
                                            </div>
                                            <div class="col-xl-9">
                                                <input type="text" class="form-control" placeholder="Placeholder"
                                                    value="wcsrm.com/">
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item p-4">
                                        <span class="fw-medium fs-15 d-block mb-3">About :</span>
                                        <div class="row gy-4 align-items-center">
                                            <div class="col-xl-3">
                                                <div class="lh-1">
                                                    <span class="fw-medium">Biographical Info :</span>
                                                </div>
                                            </div>
                                            <div class="col-xl-9">
                                                <textarea class="form-control" id="text-area" rows="4">Hey there! I'm [Your Name], a passionate [Your Profession/Interest] based in [Your Location]. With a love for [Your Hobbies/Interests], I find joy in exploring the beauty of [Your Industry/Field]. Whether it's [Specific Skills or Expertise], I'm always eager to learn and grow.

                                                                    I specialize in [Your Specialization/Area of Expertise], bringing creativity and innovation to every project. From [Key Achievements] to [Notable Experiences], my journey has been a thrilling ride, and I'm excited to share it with you.
                                                                    </textarea>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item p-4">
                                        <span class="fw-medium fs-15 d-block mb-3">Skills :</span>
                                        <div class="row gy-4 align-items-center">
                                            <div class="col-xl-3">
                                                <div class="lh-1">
                                                    <span class="fw-medium">Skills :</span>
                                                </div>
                                            </div>
                                            <div class="col-xl-9 mb-3">
                                                <input class="form-control" id="choices-text-preset-values" type="text"
                                                    value="Project Management,Data Analysis,Marketing Strategy,Graphic Design,Content Creation,Market Research,Client Relations,Event Planning,Budgeting and Finance,Negotiation Skills,Team Collaboration,Adaptability"
                                                    placeholder="This is a placeholder">
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane p-0 border-0" id="gallery-tab-pane" role="tabpanel"
                        aria-labelledby="gallery-tab" tabindex="0">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                        <a href="backend/assets/images/media/media-40.jpg" class="glightbox card"
                                            data-gallery="gallery1">
                                            <img src="backend/assets/images/media/media-40.jpg" alt="image">
                                        </a>
                                    </div>
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                        <a href="backend/assets/images/media/media-41.jpg" class="glightbox card"
                                            data-gallery="gallery1">
                                            <img src="backend/assets/images/media/media-41.jpg" alt="image">
                                        </a>
                                    </div>
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                        <a href="backend/assets/images/media/media-42.jpg" class="glightbox card"
                                            data-gallery="gallery1">
                                            <img src="backend/assets/images/media/media-42.jpg" alt="image">
                                        </a>
                                    </div>
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                        <a href="backend/assets/images/media/media-43.jpg" class="glightbox card"
                                            data-gallery="gallery1">
                                            <img src="backend/assets/images/media/media-43.jpg" alt="image">
                                        </a>
                                    </div>
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                        <a href="backend/assets/images/media/media-44.jpg" class="glightbox card"
                                            data-gallery="gallery1">
                                            <img src="backend/assets/images/media/media-44.jpg" alt="image">
                                        </a>
                                    </div>
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                        <a href="backend/assets/images/media/media-45.jpg" class="glightbox card"
                                            data-gallery="gallery1">
                                            <img src="backend/assets/images/media/media-45.jpg" alt="image">
                                        </a>
                                    </div>
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                        <a href="backend/assets/images/media/media-46.jpg" class="glightbox card"
                                            data-gallery="gallery1">
                                            <img src="backend/assets/images/media/media-46.jpg" alt="image">
                                        </a>
                                    </div>
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                        <a href="backend/assets/images/media/media-60.jpg" class="glightbox card"
                                            data-gallery="gallery1">
                                            <img src="backend/assets/images/media/media-60.jpg" alt="image">
                                        </a>
                                    </div>
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                        <a href="backend/assets/images/media/media-26.jpg" class="glightbox card"
                                            data-gallery="gallery1">
                                            <img src="backend/assets/images/media/media-26.jpg" alt="image">
                                        </a>
                                    </div>
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                        <a href="backend/assets/images/media/media-32.jpg" class="glightbox card"
                                            data-gallery="gallery1">
                                            <img src="backend/assets/images/media/media-32.jpg" alt="image">
                                        </a>
                                    </div>
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                        <a href="backend/assets/images/media/media-30.jpg" class="glightbox card"
                                            data-gallery="gallery1">
                                            <img src="backend/assets/images/media/media-30.jpg" alt="image">
                                        </a>
                                    </div>
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                        <a href="backend/assets/images/media/media-31.jpg" class="glightbox card"
                                            data-gallery="gallery1">
                                            <img src="backend/assets/images/media/media-31.jpg" alt="image">
                                        </a>
                                    </div>
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                        <a href="backend/assets/images/media/media-46.jpg" class="glightbox card"
                                            data-gallery="gallery1">
                                            <img src="backend/assets/images/media/media-46.jpg" alt="image">
                                        </a>
                                    </div>
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                        <a href="backend/assets/images/media/media-59.jpg" class="glightbox card"
                                            data-gallery="gallery1">
                                            <img src="backend/assets/images/media/media-59.jpg" alt="image">
                                        </a>
                                    </div>
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                        <a href="backend/assets/images/media/media-61.jpg" class="glightbox card"
                                            data-gallery="gallery1">
                                            <img src="backend/assets/images/media/media-61.jpg" alt="image">
                                        </a>
                                    </div>
                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12">
                                        <a href="backend/assets/images/media/media-42.jpg" class="glightbox card"
                                            data-gallery="gallery1">
                                            <img src="backend/assets/images/media/media-42.jpg" alt="image">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane p-0 border-0" id="friends-tab-pane" role="tabpanel"
                        aria-labelledby="friends-tab" tabindex="0">
                        <div class="card custom-card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <div class="card custom-card shadow-none border">
                                            <div class="card-body">
                                                <div class="d-flex align-items-start gap-2"> <span
                                                        class="avatar avatar-xl p-1 bg-light border avatar-rounded flex-shrink-0">
                                                        <img src="backend/assets/images/faces/2.jpg" alt="">
                                                    </span>
                                                    <div class="text-truncate"> <a href="javascript:void(0);"
                                                            class="mb-0 fw-semibold">Della Jasmine</a>
                                                        <p class="w-75 text-truncate fs-12 op-7 mb-1 text-muted">
                                                            dellajasmine117@gmail.com</p><span
                                                            class="badge bg-info-transparent">Product
                                                            Designer</span>
                                                    </div>
                                                    <div class="dropdown ms-auto"> <a aria-label="anchor"
                                                            class="btn btn-light btn-icon btn-sm btn-wave waves-effect waves-light"
                                                            href="javascript:void(0);" data-bs-toggle="dropdown"> <i
                                                                class="ri-more-2-fill"></i> </a>
                                                        <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                                            <li><a class="dropdown-item"
                                                                    href="javascript:void(0);">Message</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="javascript:void(0);">Block</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="javascript:void(0);">Remove</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-center p-3">
                                                <div class="d-flex gap-2 flex-wrap justify-content-center">
                                                    <button
                                                        class="btn btn-sm btn-primary-light btn-wave me-0 waves-effect waves-light">View
                                                        Profile</button> <button
                                                        class="btn btn-sm btn-secondary-light btn-wave me-0 waves-effect waves-light">Unfollow</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <div class="card custom-card shadow-none border">
                                            <div class="card-body">
                                                <div class="d-flex align-items-start gap-2"> <span
                                                        class="avatar avatar-xl p-1 bg-light border avatar-rounded flex-shrink-0">
                                                        <img src="backend/assets/images/faces/15.jpg" alt="">
                                                    </span>
                                                    <div class="text-truncate">
                                                        <p class="mb-0 fw-semibold">Danny Raj</p>
                                                        <p class="w-75 text-truncate fs-12 op-7 mb-1 text-muted">
                                                            dannyraj658@gmail.com</p><span
                                                            class="badge bg-success-transparent">UI
                                                            Designer</span>
                                                    </div>
                                                    <div class="dropdown ms-auto"> <a aria-label="anchor"
                                                            class="btn btn-light btn-icon btn-sm btn-wave waves-effect waves-light"
                                                            href="javascript:void(0);" data-bs-toggle="dropdown"> <i
                                                                class="ri-more-2-fill"></i> </a>
                                                        <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                                            <li><a class="dropdown-item"
                                                                    href="javascript:void(0);">Message</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="javascript:void(0);">Block</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="javascript:void(0);">Remove</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-center p-3">
                                                <div class="d-flex gap-2 flex-wrap justify-content-center">
                                                    <button
                                                        class="btn btn-sm btn-primary-light btn-wave me-0 waves-effect waves-light">View
                                                        Profile</button> <button
                                                        class="btn btn-sm btn-secondary-light btn-wave me-0 waves-effect waves-light">Unfollow</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <div class="card custom-card shadow-none border">
                                            <div class="card-body">
                                                <div class="d-flex align-items-start gap-2"> <span
                                                        class="avatar avatar-xl p-1 bg-light border avatar-rounded flex-shrink-0">
                                                        <img src="backend/assets/images/faces/5.jpg" alt="">
                                                    </span>
                                                    <div class="text-truncate">
                                                        <p class="mb-0 fw-semibold">Catalina Keira</p>
                                                        <p class="w-75 text-truncate fs-12 op-7 mb-1 text-muted">
                                                            catalinakeira023@gmail.com</p><span
                                                            class="badge bg-info-transparent">Product
                                                            Designer</span>
                                                    </div>
                                                    <div class="dropdown ms-auto"> <a aria-label="anchor"
                                                            class="btn btn-light btn-icon btn-sm btn-wave waves-effect waves-light"
                                                            href="javascript:void(0);" data-bs-toggle="dropdown"> <i
                                                                class="ri-more-2-fill"></i> </a>
                                                        <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                                            <li><a class="dropdown-item"
                                                                    href="javascript:void(0);">Message</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="javascript:void(0);">Block</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="javascript:void(0);">Remove</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-center p-3">
                                                <div class="d-flex gap-2 flex-wrap justify-content-center">
                                                    <button
                                                        class="btn btn-sm btn-primary-light btn-wave me-0 waves-effect waves-light">View
                                                        Profile</button> <button
                                                        class="btn btn-sm btn-secondary-light btn-wave me-0 waves-effect waves-light">Unfollow</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <div class="card custom-card shadow-none border">
                                            <div class="card-body">
                                                <div class="d-flex align-items-start gap-2"> <span
                                                        class="avatar avatar-xl p-1 bg-light border avatar-rounded flex-shrink-0">
                                                        <img src="backend/assets/images/faces/11.jpg" alt="">
                                                    </span>
                                                    <div class="text-truncate">
                                                        <p class="mb-0 fw-semibold">Priceton Gray</p>
                                                        <p class="w-75 text-truncate fs-12 op-7 mb-1 text-muted">
                                                            pricetongray451@gmail.com</p><span
                                                            class="badge bg-warning-transparent">Team
                                                            Manager</span>
                                                    </div>
                                                    <div class="dropdown ms-auto"> <a aria-label="anchor"
                                                            class="btn btn-light btn-icon btn-sm btn-wave waves-effect waves-light"
                                                            href="javascript:void(0);" data-bs-toggle="dropdown"> <i
                                                                class="ri-more-2-fill"></i> </a>
                                                        <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                                            <li><a class="dropdown-item"
                                                                    href="javascript:void(0);">Message</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="javascript:void(0);">Block</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="javascript:void(0);">Remove</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-center p-3">
                                                <div class="d-flex gap-2 flex-wrap justify-content-center">
                                                    <button
                                                        class="btn btn-sm btn-primary-light btn-wave me-0 waves-effect waves-light">View
                                                        Profile</button> <button
                                                        class="btn btn-sm btn-secondary-light btn-wave me-0 waves-effect waves-light">Unfollow</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <div class="card custom-card shadow-none border">
                                            <div class="card-body">
                                                <div class="d-flex align-items-start gap-2"> <span
                                                        class="avatar avatar-xl p-1 bg-light border avatar-rounded flex-shrink-0">
                                                        <img src="backend/assets/images/faces/7.jpg" alt="">
                                                    </span>
                                                    <div class="text-truncate">
                                                        <p class="mb-0 fw-semibold">Sarah Ruth</p>
                                                        <p class="w-75 text-truncate fs-12 op-7 mb-1 text-muted">
                                                            sarahruth45@gmail.com</p><span
                                                            class="badge bg-info-transparent">Product
                                                            Designer</span>
                                                    </div>
                                                    <div class="dropdown ms-auto"> <a aria-label="anchor"
                                                            class="btn btn-light btn-icon btn-sm btn-wave waves-effect waves-light"
                                                            href="javascript:void(0);" data-bs-toggle="dropdown"> <i
                                                                class="ri-more-2-fill"></i> </a>
                                                        <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                                            <li><a class="dropdown-item"
                                                                    href="javascript:void(0);">Message</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="javascript:void(0);">Block</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="javascript:void(0);">Remove</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-center p-3">
                                                <div class="d-flex gap-2 flex-wrap justify-content-center">
                                                    <button
                                                        class="btn btn-sm btn-primary-light btn-wave me-0 waves-effect waves-light">View
                                                        Profile</button> <button
                                                        class="btn btn-sm btn-secondary-light btn-wave me-0 waves-effect waves-light">Unfollow</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <div class="card custom-card shadow-none border">
                                            <div class="card-body">
                                                <div class="d-flex align-items-start gap-2"> <span
                                                        class="avatar avatar-xl p-1 bg-light border avatar-rounded flex-shrink-0">
                                                        <img src="backend/assets/images/faces/12.jpg" alt="">
                                                    </span>
                                                    <div class="text-truncate">
                                                        <p class="mb-0 fw-semibold">Mahira Hose</p>
                                                        <p class="w-75 text-truncate fs-12 op-7 mb-1 text-muted">
                                                            mahirahose9456@gmail.com</p><span
                                                            class="badge bg-info-transparent">Product
                                                            Designer</span>
                                                    </div>
                                                    <div class="dropdown ms-auto"> <a aria-label="anchor"
                                                            class="btn btn-light btn-icon btn-sm btn-wave waves-effect waves-light"
                                                            href="javascript:void(0);" data-bs-toggle="dropdown"> <i
                                                                class="ri-more-2-fill"></i> </a>
                                                        <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                                            <li><a class="dropdown-item"
                                                                    href="javascript:void(0);">Message</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="javascript:void(0);">Block</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="javascript:void(0);">Remove</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-center p-3">
                                                <div class="d-flex gap-2 flex-wrap justify-content-center">
                                                    <button
                                                        class="btn btn-sm btn-primary-light btn-wave me-0 waves-effect waves-light">View
                                                        Profile</button> <button
                                                        class="btn btn-sm btn-secondary-light btn-wave me-0 waves-effect waves-light">Unfollow</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <div class="card custom-card shadow-none border">
                                            <div class="card-body">
                                                <div class="d-flex align-items-start gap-2"> <span
                                                        class="avatar avatar-xl p-1 bg-light border avatar-rounded flex-shrink-0">
                                                        <img src="backend/assets/images/faces/1.jpg" alt="">
                                                    </span>
                                                    <div class="text-truncate">
                                                        <p class="mb-0 fw-semibold">Victoria Gracie</p>
                                                        <p class="w-75 text-truncate fs-12 op-7 mb-1 text-muted">
                                                            victoriagracie@gmail.com</p><span
                                                            class="badge bg-info-transparent">Product
                                                            Designer</span>
                                                    </div>
                                                    <div class="dropdown ms-auto"> <a aria-label="anchor"
                                                            class="btn btn-light btn-icon btn-sm btn-wave waves-effect waves-light"
                                                            href="javascript:void(0);" data-bs-toggle="dropdown"> <i
                                                                class="ri-more-2-fill"></i> </a>
                                                        <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                                            <li><a class="dropdown-item"
                                                                    href="javascript:void(0);">Message</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="javascript:void(0);">Block</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="javascript:void(0);">Remove</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-center p-3">
                                                <div class="d-flex gap-2 flex-wrap justify-content-center">
                                                    <button
                                                        class="btn btn-sm btn-primary-light btn-wave me-0 waves-effect waves-light">View
                                                        Profile</button> <button
                                                        class="btn btn-sm btn-secondary-light btn-wave me-0 waves-effect waves-light">Unfollow</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <div class="card custom-card shadow-none border">
                                            <div class="card-body">
                                                <div class="d-flex align-items-start gap-2"> <span
                                                        class="avatar avatar-xl p-1 bg-light border avatar-rounded flex-shrink-0">
                                                        <img src="backend/assets/images/faces/13.jpg" alt="">
                                                    </span>
                                                    <div class="text-truncate">
                                                        <p class="mb-0 fw-semibold">Amith Gray</p>
                                                        <p class="w-75 text-truncate fs-12 op-7 mb-1 text-muted">
                                                            amithgray132@gmail.com</p><span
                                                            class="badge bg-info-transparent">Product
                                                            Designer</span>
                                                    </div>
                                                    <div class="dropdown ms-auto"> <a aria-label="anchor"
                                                            class="btn btn-light btn-icon btn-sm btn-wave waves-effect waves-light"
                                                            href="javascript:void(0);" data-bs-toggle="dropdown"> <i
                                                                class="ri-more-2-fill"></i> </a>
                                                        <ul class="dropdown-menu dropdown-menu-end" role="menu">
                                                            <li><a class="dropdown-item"
                                                                    href="javascript:void(0);">Message</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="javascript:void(0);">Block</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="javascript:void(0);">Remove</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-center p-3">
                                                <div class="d-flex gap-2 flex-wrap justify-content-center">
                                                    <button
                                                        class="btn btn-sm btn-primary-light btn-wave me-0 waves-effect waves-light">View
                                                        Profile</button> <button
                                                        class="btn btn-sm btn-secondary-light btn-wave me-0 waves-effect waves-light">Unfollow</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="text-center"> <button
                                                class="btn btn-primary-light btn-wave waves-effect waves-light">Show
                                                All</button> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection